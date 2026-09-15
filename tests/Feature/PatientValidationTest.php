<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PatientValidationTest extends TestCase
{
    use RefreshDatabase;

    private function patientData(array $overrides = []): array
    {
        return array_merge([
            'full_name' => 'Test Patient',
            'national_id_number' => 'TEST-001',
            'age' => 25,
            'email' => 'patient@example.test',
            'gender' => 'female',
            'phone' => '+905551234567',
            'address' => 'Test address',
        ], $overrides);
    }

    public static function validPhones(): array
    {
        return [['0123456'], ['123456789012345'], ['+905551234567']];
    }

    public static function invalidPhones(): array
    {
        return [['123456'], ['1234567890123456'], ['abc1234567'], ['123+4567'], ['123 4567']];
    }

    #[DataProvider('validPhones')]
    public function test_valid_phone_can_be_saved_and_updated(string $phone): void
    {
        $this->actingAs(User::factory()->create());
        $data = $this->patientData(['phone' => $phone]);

        $this->post(route('patients.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('patients.index'));
        $this->assertDatabaseHas('patients', $data);

        $patient = Patient::firstOrFail();
        $data['full_name'] = 'Updated Test Patient';
        $this->put(route('patients.update', $patient), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('patients.index'));
        $this->assertDatabaseHas('patients', ['id' => $patient->id] + $data);
        $this->assertDatabaseCount('patients', 1);
    }

    #[DataProvider('invalidPhones')]
    public function test_invalid_phone_is_rejected_on_create_and_update(string $phone): void
    {
        $this->actingAs(User::factory()->create());
        $this->post(route('patients.store'), $this->patientData(['phone' => $phone]))
            ->assertSessionHasErrors('phone');
        $this->assertDatabaseCount('patients', 0);

        $original = $this->patientData();
        $patient = Patient::create($original);
        $this->put(route('patients.update', $patient), $this->patientData([
            'phone' => $phone,
            'full_name' => 'Must not be saved',
        ]))->assertSessionHasErrors('phone');
        $this->assertDatabaseHas('patients', ['id' => $patient->id] + $original);
    }

    public function test_another_patients_national_id_is_rejected_on_create_and_update(): void
    {
        $this->actingAs(User::factory()->create());
        $first = Patient::create($this->patientData());
        $second = Patient::create($this->patientData(['national_id_number' => 'TEST-002']));

        $this->post(route('patients.store'), $this->patientData())
            ->assertSessionHasErrors('national_id_number');
        $this->put(route('patients.update', $second), $this->patientData())
            ->assertSessionHasErrors('national_id_number');
        $this->assertSame('TEST-002', $second->fresh()->national_id_number);
        $this->assertSame('TEST-001', $first->fresh()->national_id_number);
        $this->assertDatabaseCount('patients', 2);
    }

    public function test_invalid_age_is_rejected_on_create_and_update(): void
    {
        $this->actingAs(User::factory()->create());
        $invalid = $this->patientData(['age' => 400]);
        $this->post(route('patients.store'), $invalid)->assertSessionHasErrors('age');
        $this->assertDatabaseCount('patients', 0);

        $patient = Patient::create($this->patientData());
        $this->put(route('patients.update', $patient), $invalid)->assertSessionHasErrors('age');
        $this->assertSame(25, (int) $patient->fresh()->age);
    }

    public function test_missing_patient_returns_not_found(): void
    {
        $this->actingAs(User::factory()->create())
            ->put(route('patients.update', 999999), $this->patientData())
            ->assertNotFound();
        $this->assertDatabaseCount('patients', 0);
    }
}
