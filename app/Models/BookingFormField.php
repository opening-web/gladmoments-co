<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingFormField extends Model
{
    protected $fillable = [
        'booking_form_id',
        'field_name',
        'field_label',
        'field_type',
        'required',
        'placeholder',
        'help_text',
        'validation_rules',
        'options',
        'order',
        'is_active',
    ];

    protected $casts = [
        'required' => 'boolean',
        'is_active' => 'boolean',
        'validation_rules' => 'json',
        'options' => 'json',
    ];

    public function bookingForm(): BelongsTo
    {
        return $this->belongsTo(BookingForm::class);
    }

    public function getValidationRuleString(): string
    {
        $rules = [];

        if ($this->required) {
            $rules[] = 'required';
        }

        switch ($this->field_type) {
            case 'email':
                $rules[] = 'email';
                break;
            case 'phone':
                $rules[] = 'regex:/^[0-9]+$/';
                $rules[] = 'max:20';
                break;
            case 'number':
                $rules[] = 'numeric';
                break;
            case 'date':
                $rules[] = 'date';
                $rules[] = 'after_or_equal:today';
                break;
            case 'file':
                $rules[] = 'file';
                if ($this->validation_rules) {
                    if (isset($this->validation_rules['mimes'])) {
                        $rules[] = 'mimes:' . implode(',', (array) $this->validation_rules['mimes']);
                    }
                    if (isset($this->validation_rules['max_size'])) {
                        $rules[] = 'max:' . $this->validation_rules['max_size'];
                    }
                }
                break;
            case 'text':
            case 'textarea':
                if ($this->validation_rules && isset($this->validation_rules['max'])) {
                    $rules[] = 'max:' . $this->validation_rules['max'];
                }
                break;
        }

        return implode('|', $rules);
    }
}
