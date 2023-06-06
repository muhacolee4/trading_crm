<div class="row">
    <div class="col-md-12">
        <h4>Configuration</h4>
        <hr>
    </div>
    <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="emailform">
            @csrf
            @method('PUT')
            <div class=" form-row">
                <div class="form-group col-md-12">
                    <div class="">
                        <h5 class="">Mail Server</h5>
                        <div class="selectgroup">
                            <label class="selectgroup-item">
                                <input type="radio" name="server" id="sendmailserver" value="sendmail"
                                    class="selectgroup-input" checked="">
                                <span class="selectgroup-button">Sendmail</span>
                            </label>
                            <label class="selectgroup-item">
                                <input type="radio" name="server" id="smtpserver" value="smtp"
                                    class="selectgroup-input">
                                <span class="selectgroup-button">SMTP</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Email From</h5>
                    <input type="email" name="emailfrom" class="form-control  " value="{{ $settings->emailfrom }}"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Email From Name</h5>
                    <input type="text" name="emailfromname" class="form-control  "
                        value="{{ $settings->emailfromname }}" required>
                </div>
                <div class="form-group col-md-6 smtp d-none">
                    <h5 class="">SMTP Host</h5>
                    <input type="text" name="smtp_host" class="form-control   smtpinput"
                        value="{{ $settings->smtp_host }}">
                </div>
                <div class="form-group col-md-6 smtp d-none">
                    <h5 class="">SMPT Port</h5>
                    <input type="text" name="smtp_port" class="form-control   smtpinput"
                        value="{{ $settings->smtp_port }}">
                </div>
                <div class="form-group col-md-6 smtp d-none">
                    <h5 class="">SMPT Encryption</h5>
                    <input type="text" name="smtp_encrypt" class="form-control   smtpinput"
                        value="{{ $settings->smtp_encrypt }}">
                </div>
                <div class="form-group col-md-6 smtp d-none">
                    <h5 class="">SMPT Username</h5>
                    <input type="text" name="smtp_user" class="form-control   smtpinput"
                        value="{{ $settings->smtp_user }}">
                </div>
                <div class="form-group col-md-6 smtp d-none">
                    <h5 class="">SMPT Password</h5>
                    <input type="text" name="smtp_password" class="form-control   smtpinput"
                        value="{{ $settings->smtp_password }}">
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="col-md-12">
                    <h4>Google Login Credentials</h4>
                    <hr>
                </div>
            </div>
            <div class=" form-row">
                <div class="form-group col-md-6">
                    <h5 class="">Client ID</h5>
                    <input type="text" name="google_id" class="form-control  " value="{{ $settings->google_id }}">
                    <small class=""> From console.cloud.google.com</small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Client Secret</h5>
                    <input type="text" name="google_secret" class="form-control  "
                        value="{{ $settings->google_secret }}">
                    <small class=""> From console.cloud.google.com</small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Redirect URL</h5>
                    <input type="text" name="google_redirect" class="form-control  "
                        value="{{ $settings->google_redirect }}">
                    <small class="">Set this to your Valid OAuth Redirect URI in console.cloud.google.com. Be sure
                        to replace the 'yoursite.com' with your website url </small>
                </div>
            </div>
            <div class="mt-4 form-row">
                <div class="col-md-12">
                    <h4>Google Captcha Credentials</h4>
                    <hr>
                </div>
            </div>
            <div class=" form-row">
                <div class="form-group col-md-6">
                    <h5 class="">Captcha Secret</h5>
                    <input type="text" name="capt_secret" class="form-control  "
                        value="{{ $settings->capt_secret }}">
                    <small class=""> From https://www.google.com/recaptcha/admin/create </small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Captcha Site-Key</h5>
                    <input type="text" name="capt_sitekey" class="form-control  "
                        value="{{ $settings->capt_sitekey }}">
                    <small class=""> From https://www.google.com/recaptcha/admin/create</small>
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Save">
                </div>
            </div>
        </form>
    </div>
</div>


@if ($settings->mail_server == 'sendmail')
    <script>
        document.getElementById("sendmailserver").checked = true;
    </script>
@else
    <script>
        document.getElementById("smtpserver").checked = true;
    </script>
@endif
