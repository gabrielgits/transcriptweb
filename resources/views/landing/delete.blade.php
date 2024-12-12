@extends('landing.layout')

@section('menu')
  <li class="scroll-to-section"><a href="{{ route('home') }}" class="active">Inicio</a></li>
@endsection

@section('content')

    <div id="services" class="services section">

        <div class="col-12">

            <div class="container">
                <h1>Delete Account Instructions</h1>
                <p>If you wish to delete your account, please follow the instructions below:</p>
                <h2>Step-by-Step Instructions</h2>
                <ul>
                    <li>Open your email client or webmail service.</li>
                    <li>Compose a new email addressed to: <strong>gabriel.vieira24@outlook.com</strong></li>
                    <li>In the subject line, please write: <strong>Request for Account Deletion</strong></li>
                    <li>In the body of the email, include the following information:</li>
                    <ul>
                        <li>Your full name</li>
                        <li>Your account username</li>
                        <li>Your registered phone</li>
                        <li>A brief statement requesting the deletion of your account</li>
                    </ul>
                </ul>
                <h2>Sample Email</h2>
                <p>Here is a sample email format you can use:</p>
                <blockquote>
                    <p><strong>To:</strong> gabriel.vieira24@outlook.com</p>
                    <p><strong>Subject:</strong> Request for Account Deletion</p>
                    <p>Dear Support Team,</p>
                    <p>I am writing to request the deletion of my account with the following details:</p>
                    <ul>
                        <li><strong>Full Name:</strong> [Your Full Name]</li>
                        <li><strong>Username:</strong> [Your Username]</li>
                        <li><strong>Registered Phone:</strong> [Your Registered Phone]</li>
                    </ul>
                    <p>Please process this request at your earliest convenience. Thank you.</p>
                    <p>Sincerely,</p>
                    <p>[Your Full Name]</p>
                </blockquote>
                <h2>Confirmation</h2>
                <p>Once your request has been processed, you will receive a confirmation email from our support team.
                </p>
                <h2>Contact Us</h2>
                <p>If you have any questions or need further assistance, please contact us at:
                    <strong>gabriel.vieira24@outlook.com</strong>
                </p>
            </div>

        </div>
@endsection