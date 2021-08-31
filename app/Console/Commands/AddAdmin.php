<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * return int
     */
    public function handle()
    {
        $name = $this->askValid('Admin name?', 'name', ['required','min:3', 'string', 'max:255', 'unique:users,name']);
        $lastName = $this->askValid('Admin lastname?', 'last_name', ['required','min:3', 'string', 'max:255', 'unique:users,name']);
        $email = $this->askValid('Admin email?', 'email', ['required','email', 'max:255', 'unique:users,email']);
        $password = $this->askValid('Admin password? Min. 8 character', 'password', ['required','min:8']);
        $confirmPassword = $this->askValid('Confirm password? Min. 8 character', 'password', ['required','min:8', 'in:'.$password]);
        User::query()->create(
            [
                'name' => $name,
                'last_name' => $lastName,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ]
        );
        $this->info('Admin user was successfully added!');
    }

    protected function askValid($question, $field, $rules)
    {
        $value = $this->ask($question);
        if ($message = $this->validateInput($rules, $field, $value)) {
            $this->error($message);
            return $this->askValid($question, $field, $rules);
        }
        return $value;
    }

    protected function validateInput($rules, $fieldName, $value): ?string
    {
        $validator = Validator::make(
            [ $fieldName => $value ],
            [$fieldName => $rules]
        );
        return $validator->fails() ? $validator->errors()->first($fieldName) : null;
    }
}
