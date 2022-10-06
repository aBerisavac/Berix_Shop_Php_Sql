<div id="logIn" class="allScreenPopUp">
    <div class="credentialWrapper">
        <h3>Welcome back</h3>
        <form action="" method="POST" id="login-form" name="login-form">

            <div class="popUpInput">
                <label for="loginEmail">Email: </label><span id="inputLoginEmail">*</span>
                <input type="text" placeholder="Enter your email" id="loginEmail" name="loginEmail" />
            </div>

            <div class="popUpInput">
                <label for="loginPassword">Password: </label><span id="inputLoginPassword">*</span>
                <input type="password" placeholder="Enter your password" id="loginPassword" name="loginPassword" />
            </div>

        </form>
        
        <div class="buttonContainer">
            <span id="isLoginValid"></span>
            <button type="button" id="login">Login</button>
        </div>
        <div id="register-forgotPassword">
            <button type="button" id="goRegister">Sign Up</button>
            <button type="button" id="forgotPassword">Forgot your password?</button>

        </div>
        <div class="buttonContainer">
            <button type="button" id="back">Return</button>
        </div>
    </div>
</div>