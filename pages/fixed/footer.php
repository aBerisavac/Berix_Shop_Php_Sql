
    <form action="1.php" method="GET" name="contact-form" id="contact-form">
        <fieldset>
            <legend>Contact Information</legend>

            <label for="name">Your name:</label><span id="inputName"></span>
            <input type="text" placeholder="First_Name Last_Name Middle_Name" id="name" name="name" maxlength="30" />

            <label for="phone">Phone Number:</label><span id="inputPhone"></span>
            <input type="text" placeholder="Use +<country_number> format please" id="phone" name="phone" maxlength="15" />

            <label for="emailaddress">e-mail:</label><span id="inputMail"></span>
            <input type="email" id="emailAddress" name="emailAddress" placeholder="Enter your e-mail here">

            <label for="message">Message:</label><span id="inputText"> *Field Required</span>
            <textarea required="required" placeholder="Type Your Message here:" id="message" rows="3" cols="20" name="message"></textarea>

            <div id="contactBtn">
                <span id="contactButtonText"></span>
                <input type="button" value="Send" id="buttonFooter" />
            </div>
        </fieldset>
    </form>
    <div id="icons">
        <ul>
            <?php 

                $getFooterItems="SELECT * FROM footer_pic_elements";
                $prepare = $conn->prepare($getFooterItems);
                $prepare->execute();
                $footerItems=$prepare->fetchAll();

                foreach($footerItems as $footerItem):
            ?>

            <?php if($footerItem->src=="https://www.facebook.com/alexa.berisavac"): ?>
            <a href="<?= $footerItem->src ?>"><li> <i class="<?= $footerItem->fa_fa ?>"></i> </li></a>
            <?php endif ?>

            <a href="../../<?= $footerItem->src ?>"><li> <i class="<?= $footerItem->fa_fa ?>"></i> </li></a>

            <?php endforeach ?>
        </ul>
    </div>