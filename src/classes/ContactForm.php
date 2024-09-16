<?php 

namespace App;

class ContactForm
{
    protected $input = [];

    protected $errors = [];

    public function __construct(array $post)
    {
        $this->input = $this->sanitise($post);
    }

    public function getInput($field = null)
    {
        if (!$field) {
            return $this->input;
        }
        return $this->input[$field] ?? null;
    }

    protected function sanitise(array $post)
    {
        return [
            'first_name' => isset($post['first_name']) ? htmlspecialchars(strip_tags($post['first_name'])) : null,
            'last_name' => isset($post['last_name']) ? htmlspecialchars(strip_tags($post['last_name'])) : null,
            'email' => isset($post['email']) ? filter_var($post['email'], FILTER_VALIDATE_EMAIL) : null,
            'phone' => isset($post['phone']) ? htmlspecialchars(strip_tags($post['phone'])) : null,
            'subject' => isset($post['subject']) ? htmlspecialchars(strip_tags($post['subject'])) : null,
            'message' => isset($post['message']) ? htmlspecialchars(strip_tags($post['message'])) : null,
        ];
    }

    public function validate()
    {
        if (!$this->input['first_name']) {
            $this->addError('first_name', 'Please enter your first name.');
        }
        if (!$this->input['last_name']) {
            $this->addError('last_name', 'Please enter your last name.');
        }
        if (!$this->input['email'] || !filter_var($this->input['email'], FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'Please enter a valid email address.');
        }
        $phone = str_replace(' ', '', $this->input['phone']);
        if (!$phone || !is_numeric($phone) || strlen($phone) != 11) {
            $this->addError('phone', 'Please enter a valid phone number.');
        }
        if (!$this->input['subject']) {
            $this->addError('subject', 'Please enter a subject.');
        }
        if (!$this->input['message']) {
            $this->addError('message', 'Please enter a message.');
        }

        return !$this->hasErrors();
    }

    protected function addError($field, string $msg)
    {
        $this->errors[$field] = $msg;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getError($field)
    {
        return $this->errors[$field] ?? null;
    }
}