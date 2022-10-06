<div id="recoverPassword" class="allScreenPopUp">
    <div class="credentialWrapper">
        <h3>Recover your password: </h3>
        <form action="" method="POST" id="recover-password" name="recover-password">

            <div class="popUpInput"><span id="inputRecoveryEmail">*</span>
                <label for="recoveryEmail">Email: </label>
                <input type="text" placeholder="Enter your email" id="recoveryEmail" name="recoveryEmail" />
            </div>

            <div class="popUpInput"><span id="inputRecoveryPassword">*</span>
                <label for="recoveryPassword">New password: </label>
                <input type="password" placeholder="Enter your email" id="recoveryPassword" name="recoveryPassword" />
            </div>

        </form>

        <div class="buttonContainer"><span id="isDataValid"></span>
            <button type="button" id="recoverPass">Recover</button>
        </div>
        <div class="buttonContainer">
            <button type="button" class="backToMain">Return</button>
        </div>
    </div>
</div>