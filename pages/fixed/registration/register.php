<div id="register" class="allScreenPopUp">
    <div class="credentialWrapper">
        <h3>Join up!</h3>
        <form action="" method="POST" id="register-form" name="register-form">

            <div class="popUpInput">
                <label for="registerName">Your name: </label><span id="inputRegisterName">*</span>
                <input type="text" placeholder="First_Name Last_Name Middle_Name" id="registerName" name="registerName" />
            </div>

            <div class="popUpInput">
                <label for="registerEmail">Email: </label><span id="inputRegisterMail">*</span>
                <input type="text" placeholder="Enter your email" id="registerEmail" name="registerEmail" />
            </div>

            <div class="popUpInput">
                <label for="registerPassword">Password: </label><span id="inputRegisterPassword">*</span>
                <input type="password" placeholder="Enter your password" id="registerPassword" name="registerPassword" />
            </div>

            <div class="popUpInput">
                <label for="registerPhoneNumber">Phone number: </label><span id="inputRegisterPhone"></span>
                <input type="text" placeholder="Use +<country_number> format please" id="registerPhoneNumber" name="registerPhoneNumber" />
            </div>

        </form>
        <div class="buttonContainer">
            <span id="isRegistrationValid"></span>
            <button type="button" id="registerUser">Register</button>
        </div>
        <div class="buttonContainer">
            <button type="button" class="backToMain">Return</button>
        </div>
    </div>
</div>