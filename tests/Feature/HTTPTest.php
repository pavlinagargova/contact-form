<?php

namespace Tests\Feature;

use App\Mail\InquiryForm;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class HTTPTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testFormSubmitValidationFails()
    // {
    //     $response = $this->post('/formSubmit', [
    //             'name' => 'test',
    //             'email' => 'test',
    //             'phone' => '',
    //             'message' => 'test'
    //     ]);
    //     $response->assertValid();
    // }

    public function testFormSubmitValidationSuccess()
    {
        $response = $this->post('/formSubmit', [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'phone' => '0895587532',
            'message' => 'test'
        ]);
        $response->assertValid();
    }

    public function testValueSavedToDB() {
        $name = 'test';
        $email = 'test@gmail.com';
        $phone = '0895587532';
        $message = 'test';

        $data = $this->post('/formSubmit', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);

        $this->assertDatabaseHas('inquiries', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);
    }

    public function testEmailWasSent() {
        Mail::fake();
        $contact = 'test@gmail.com';
        $receiver = 'mail@example.com';
        Mail::to($receiver)
            ->send(new InquiryForm(['user' => $contact]));

        Mail::assertSent(InquiryForm::class, function ($mail) use ($receiver) {
            return $mail->hasTo($receiver);
        });
    }
}
