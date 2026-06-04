<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookingForm;
use App\Models\BookingFormField;

class PopulateDigitalInvitationFields extends Command
{
    protected $signature = 'populate:digital-invitation-fields';
    protected $description = 'Populate booking form fields for Digital Invitation form';

    public function handle()
    {
        $this->info('========================================');
        $this->info('POPULATING DIGITAL INVITATION FIELDS');
        $this->info('========================================');
        $this->newLine();

        // Get or create Digital Invitation BookingForm
        $bookingForm = BookingForm::firstOrCreate(
            ['slug' => 'digital-invitation'],
            [
                'name' => 'Digital Invitation',
                'form_type' => 'digital_invitation',
                'is_active' => true,
                'order' => 4,
                'service_id' => 8, // Digital Invitation service ID
                'description' => 'Beautiful digital invitation form for weddings and special events',
            ]
        );

        $this->line("✅ BookingForm: {$bookingForm->name} (ID: {$bookingForm->id})");

        // Clear existing fields
        $bookingForm->fields()->delete();
        $this->line("🗑️  Cleared existing fields");

        // Define all form fields
        $fields = [
            // Bride Section
            ['order' => 1, 'field_name' => 'bride_full_name', 'field_label' => 'Bride Full Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'e.g., Siti Nurhaliza', 'validation_rules' => ['max' => 255]],
            ['order' => 2, 'field_name' => 'bride_nickname', 'field_label' => 'Bride Nickname', 'field_type' => 'text', 'required' => true, 'placeholder' => 'e.g., Siti', 'validation_rules' => ['max' => 100]],
            ['order' => 3, 'field_name' => 'bride_father_name', 'field_label' => 'Bride Father Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'Father\'s full name', 'validation_rules' => ['max' => 255]],
            ['order' => 4, 'field_name' => 'bride_mother_name', 'field_label' => 'Bride Mother Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'Mother\'s full name', 'validation_rules' => ['max' => 255]],
            ['order' => 5, 'field_name' => 'bride_child_order', 'field_label' => 'Bride Child Order', 'field_type' => 'text', 'required' => false, 'placeholder' => 'e.g., 1st child, 2nd child', 'validation_rules' => ['max' => 100]],
            ['order' => 6, 'field_name' => 'bride_photo', 'field_label' => 'Bride Photo', 'field_type' => 'file', 'required' => false, 'placeholder' => 'Upload bride photo', 'validation_rules' => ['mimes' => ['jpg', 'jpeg', 'png'], 'max_size' => 5120]],

            // Groom Section
            ['order' => 7, 'field_name' => 'groom_full_name', 'field_label' => 'Groom Full Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'e.g., Ricky Harun', 'validation_rules' => ['max' => 255]],
            ['order' => 8, 'field_name' => 'groom_nickname', 'field_label' => 'Groom Nickname', 'field_type' => 'text', 'required' => true, 'placeholder' => 'e.g., Ricky', 'validation_rules' => ['max' => 100]],
            ['order' => 9, 'field_name' => 'groom_father_name', 'field_label' => 'Groom Father Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'Father\'s full name', 'validation_rules' => ['max' => 255]],
            ['order' => 10, 'field_name' => 'groom_mother_name', 'field_label' => 'Groom Mother Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'Mother\'s full name', 'validation_rules' => ['max' => 255]],
            ['order' => 11, 'field_name' => 'groom_child_order', 'field_label' => 'Groom Child Order', 'field_type' => 'text', 'required' => false, 'placeholder' => 'e.g., 1st child, 2nd child', 'validation_rules' => ['max' => 100]],
            ['order' => 12, 'field_name' => 'groom_photo', 'field_label' => 'Groom Photo', 'field_type' => 'file', 'required' => false, 'placeholder' => 'Upload groom photo', 'validation_rules' => ['mimes' => ['jpg', 'jpeg', 'png'], 'max_size' => 5120]],

            // Event Section
            ['order' => 13, 'field_name' => 'event_date', 'field_label' => 'Event Date', 'field_type' => 'date', 'required' => true, 'placeholder' => 'Select date', 'validation_rules' => ['date' => true]],
            ['order' => 14, 'field_name' => 'event_day', 'field_label' => 'Event Day', 'field_type' => 'select', 'required' => true, 'options' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], 'validation_rules' => []],
            ['order' => 15, 'field_name' => 'event_start_time', 'field_label' => 'Event Start Time', 'field_type' => 'text', 'required' => true, 'placeholder' => 'HH:MM (e.g., 10:00)', 'validation_rules' => ['max' => 10]],
            ['order' => 16, 'field_name' => 'event_end_time', 'field_label' => 'Event End Time', 'field_type' => 'text', 'required' => true, 'placeholder' => 'HH:MM (e.g., 16:00)', 'validation_rules' => ['max' => 10]],
            ['order' => 17, 'field_name' => 'event_venue_name', 'field_label' => 'Event Venue Name', 'field_type' => 'text', 'required' => true, 'placeholder' => 'e.g., Grand Ballroom Hotel', 'validation_rules' => ['max' => 255]],
            ['order' => 18, 'field_name' => 'event_address', 'field_label' => 'Event Address', 'field_type' => 'textarea', 'required' => true, 'placeholder' => 'Full address with details', 'validation_rules' => ['max' => 1000]],

            // Media Section
            ['order' => 19, 'field_name' => 'couple_photos', 'field_label' => 'Couple Photos', 'field_type' => 'file', 'required' => false, 'placeholder' => 'Upload up to 14 photos', 'validation_rules' => ['mimes' => ['jpg', 'jpeg', 'png'], 'max_size' => 5120, 'max_files' => 14]],
            ['order' => 20, 'field_name' => 'opening_quote', 'field_label' => 'Opening Quote', 'field_type' => 'textarea', 'required' => false, 'placeholder' => 'A meaningful quote for the invitation', 'validation_rules' => ['max' => 500]],
        ];

        // Create all fields
        $created = 0;
        foreach ($fields as $fieldData) {
            $field = new BookingFormField($fieldData);
            $field->booking_form_id = $bookingForm->id;
            $field->is_active = true;
            $field->save();
            $created++;
        }

        $this->info("✅ Created {$created} form fields");
        $this->newLine();

        $this->info('========================================');
        $this->info('✅ FIELDS POPULATED SUCCESSFULLY!');
        $this->info('========================================');
        $this->line("Form: {$bookingForm->name}");
        $this->line("Fields: {$created}");

        return Command::SUCCESS;
    }
}
