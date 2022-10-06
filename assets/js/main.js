$(document).ready(function () {

    function sendData(url, method, data, success, error) {
        $.ajax({
            url: url,
            method: method,
            dataType: 'json',
            data: data,
            success: success,
            error: error
        });
    };

    //setovanje pop up diva da budu nevidljivi elementi:
    $(".allScreenPopUp").children().addClass('invisible');

    //Sabmitovanje odgovora iz anketa:
    $("#submitSurveyAnswers").click(function () {
        if (selectValues.length != 0) {
            let data = { "array": selectValues };
            sendData("../../pages/database/communication/insertSurveyAnswers.php", "get", data,
                function (response) {
                    $("#submitSurveyAnswers").css("display", "none");
                    $("#isSurveyDataValid").html(response.message);
                    setTimeout(() => document.location.reload(), 2000);
                },
                function (xhr) {
                    $("#isSurveyDataValid").html(JSON.parse(xhr.responseText).message);
                    resetRecovery();
                });
        } else {
            $("#isSurveyDataValid").html("Survey selection is invalid. Please inform admins through the contact form.");
            setTimeout(() => $("#isSurveyDataValid").html(""), 5000);
        }
    });

    //Recovery passworda
    $("#recoverPass").click(function () {
        if (recoveryEmail && recoveryPassword) {
            let data = {
                "password": $("#recoveryPassword").val() == null ? null : $("#recoveryPassword").val(),
                "email": $("#recoveryEmail").val() == null ? null : $("#recoveryEmail").val()
            }
            sendData("../../pages/database/communication/changePassword.php", "post", data,
                function (response) {
                    $("#isDataValid").html(response.message);
                    setTimeout(() => $("#isDataValid").html(""), 5000);
                },
                function (xhr) {
                    $("#isDataValid").html(JSON.parse(xhr.responseText).message);
                    resetRecovery();
                });
        } else {
            $("#isDataValid").html("Email or password are incorrect.");
            setTimeout(() => $("#isDataValid").html(""), 5000);
        }
    });

    //Logovanje korisnika
    $("#login").click(function () {
        if (loginEmail && loginPassword) {
            let data = {
                "password": $("#loginPassword").val() == null ? null : $("#loginPassword").val(),
                "email": $("#loginEmail").val() == null ? null : $("#loginEmail").val()
            }
            sendData("../../pages/database/communication/userLogin.php", "post", data,
                function (response) {
                    $("#isLoginValid").html(response.message);
                    setTimeout(() => document.location.reload(), 2000);
                },
                function (xhr) {
                    $("#isLoginValid").html(JSON.parse(xhr.responseText).message);
                    resetLogin();
                });
        } else {
            $("#isLoginValid").html("Login credentials are not correct. Please try again.");
            setTimeout(() => $("#isLoginValid").html(""), 5000);
        }
    })

    //Registrovanje korisnika
    $("#registerUser").click(function () {
        if (username && password && phone && email) {
            let data = {
                "password": $("#registerPassword").val() == null ? null : $("#registerPassword").val(),
                "email": $("#registerEmail").val() == null ? null : $("#registerEmail").val(),
                "full_name": $("#registerName").val() == null ? null : $("#registerName").val(),
                "phone_number": $("#registerPhoneNumber").val() == null ? null : $("#registerPhoneNumber").val(),
            }
            sendData("../../pages/database/communication/registerUser.php", "post", data,
                function (response) {
                    $("#isRegistrationValid").html(response.message+" You will be redirected soon.");
                    setTimeout(() => $("#isRegistrationValid").html(""), 2000);
                    setTimeout(function(){
                        dropPopUp();
                    showPopUp("logIn");
                    }, 2500);
                    resetRegister();

                },
                function (xhr) {
                    $("#isRegistrationValid").html(JSON.parse(xhr.responseText).message);
                    setTimeout(() => $("#isRegistrationValid").html(""), 10000);
                });

        } else {
            $("#isRegistrationValid").html("You did not fulfill all the conditions! Please enter the information correctly.");
            setTimeout(() => $("#isRegistrationValid").html(""), 10000);
        }
    });

    //Ispitivanje forme za kontakt i slanje podataka.
    var reIme = /^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11}){1,2}/;
    var reBroj = /(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/;
    var reMail = /^\S{1,15}@\S{1,15}$/ //dozvoljavam da unesu bez .com jer moze da bude .yahoo itd. Za detaljnije mejlove bih koristio slozenije regexpove.

    var ime = 0;
    var telefon = 0;
    var mail = 0;

function checkContactForm(){
    var nameInput = document.getElementById("name");
    var phoneInput = document.getElementById("phone");
    var emailAddress = document.getElementById("emailAddress");
    var message = document.getElementById("message");

    nameInput.addEventListener("blur", function () {
        if (nameInput.value.match(reIme)) {
            inputName.textContent = "  Name Format is correct.";
            setTimeout(() => inputName.textContent = "", 5000);
            ime = 0;
        } else if (!nameInput.value) {
            inputName.textContent = "  Field is empty.";
            setTimeout(() => inputName.textContent = "", 10000);
            ime = 0;
        } else {
            inputName.textContent = "  Word begins with a capital letter followed by a non capital.";
            ime = 1;
        }
    });

    phoneInput.addEventListener("blur", function () {
        if (phoneInput.value.match(reBroj)) {
            inputPhone.textContent = "  Phone Format is correct.";
            setTimeout(() => inputPhone.textContent = "", 5000);
            telefon = 0;
        } else if (!phoneInput.value) {
            inputPhone.textContent = "  Field is empty.";
            setTimeout(() => inputPhone.textContent = "", 10000);
            telefon = 0;
        } else {
            inputPhone.textContent = "  Wrong phone format. Example: +381648586054";
            telefon = 1;
        }
    });

    emailAddress.addEventListener("blur", function () {
        if (emailAddress.value.match(reMail)) {
            inputMail.textContent = "  E-Mail format is correct. You will be asked to verify it.";
            setTimeout(() => inputMail.textContent = "", 5000);
            mail = 0;
        } else if (!emailAddress.value) {
            inputMail.textContent = "  Field is empty.";
            setTimeout(() => inputMail.textContent = "", 10000);
            mail = 0;
        } else {
            inputMail.textContent = "  Write the e-mail correctly. Example: name@yahoo.com";
            mail = 1;
        }
    });

    message.addEventListener("blur", function () {
        if (!(inputText.getAttribute("class") == "white")) {
            if (message.value == "" || message.value.length > 500) {
                inputText.textContent = "  Write something if you want to send a message. Maximum length is 500 characters.";
                setTimeout(() => inputText.textContent = "*Field Required", 10000);
                inputText.setAttribute("class", "white");
                setTimeout(() => inputText.setAttribute("class", ""), 10000);
            }
        }
    });

    //Funkcija za resetovanje elemenata forme prilikom slanja podataka

    function resetuj() {
        var nizReset = new Array();
        nizReset = $('input');
        nizReset.push($('#message')[0]);
        //console.log(nizReset);
        for (i = 0; i < nizReset.length; i++) {
            if (nizReset[i].id != "buttonFooter") {
                nizReset[i].value = "";
                //console.log(nizReset[i].id);
            }
        }
    }

    //Sabmitovanje podataka iz futera

    function successfullMessageBackEndCheck() {
        contactButtonText.textContent = "You have successfully sent your message! Thank you for your commitment.";
        setTimeout(() => contactButtonText.textContent = "", 10000);
    }

    function unsuccessfullMessageBackEndCheck() {
        contactButtonText.textContent = "You did not fulfill all the conditions, and this error comes from the server! Please enter the information correctly, and in this form, or don't fill it at all if you want to keep your privacy.";
        setTimeout(() => contactButtonText.textContent = "", 10000);
    }

    buttonFooter.addEventListener("click", function () {
        if ((message.value != "") && !((ime) || (telefon) || (mail))) {

            //Slanje podataka ajaksom ka backu na proveru

            data = {
                "full_name": nameInput.value == null ? null : nameInput.value,
                "phone_number": phoneInput == null ? null : phoneInput.value,
                "email": emailAddress == null ? null : emailAddress.value,
                "message": message.value
            }

            sendData("../../pages/database/communication/insertMessage.php", "get", data,
                function (response) {
                    if (response.length > 0) {
                        unsuccessfullMessageBackEndCheck();
                    } else {
                        successfullMessageBackEndCheck();
                    }
                },
                function (xhr) {
                    unsuccessfullBackEndCheck();
                }
            );

        } else {
            contactButtonText.textContent = "You did not fulfill all the conditions! Please enter the information correctly, or don't fill it at all if you want to keep your privacy.";
            setTimeout(() => contactButtonText.textContent = "", 10000);
        }
        resetuj();
    });
}

checkContactForm();


    // ==================== GOTOVO FUTER    =============================


    //Ispis proizvoda unutar shop-a:

    function getProducts() {
        let data = {
            "sort": localStorage.getItem("sort"),
            "searchTerm": localStorage.getItem("searchTerm"),
            "onDiscount": localStorage.getItem("onDiscount"),
            "slider": localStorage.getItem("slider"),
            "brands": localStorage.getItem("brands"),
            "categories": localStorage.getItem("categories"),
            "displayMethod": localStorage.getItem("displayMethod"),
            "pagination": localStorage.getItem("pagination")
        };
        sendData("../../pages/database/communication/getProducts.php", "get", data,

            function (response) {
                localStorage.setItem("products", JSON.stringify(response.products));
                localStorage.setItem("numberOfProducts", response.numberOfProducts);

                writeProducts();
                writeCartAside();
                addListenerForBuying();

                if (localStorage.getItem("displayMethod") == 2) {
                    writePagination(6);
                    paginationClick();
                } else {
                    writePagination(15);
                    paginationClick();
                }
            },

            function (xhr) {
                console.log(xhr.responseText);
            },
        );

    }


    //SHOP MAIN CONTENT

    localStorage.setItem("pagination", 1);
    localStorage.setItem("displayMethod", 3);
    localStorage.setItem("categories", "");
    localStorage.setItem("brands", "");
    localStorage.setItem("slider", "");
    localStorage.setItem("onDiscount", "false");
    localStorage.setItem("searchTerm", "");
    localStorage.setItem("sort", "default");

    var path = window.location.pathname.split("/");
    var path = path[path.length - 1];
    if (path == "shopContent.php") {

        /*=====================================FILTERI================================*/

        //Sortiranje
        $("#sort").change(function () {
            localStorage.setItem("sort", $("#sort input:checked")[0].value);
            getProducts();
        })

        //Pretraga
        $("#term").change(function () {
            localStorage.setItem("searchTerm", $(this)[0].value);
            getProducts();
        })

        //Na Snizenju
        $("#onDiscount").change(function () {
            localStorage.setItem("onDiscount", $(this)[0].checked);
            getProducts();
        });

        //slider ponasanje
        if ($("#slider-range")[0]) {
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 500,
                    values: [0, 500],
                    step: 5,
                    //change: function () { ispisProizvoda() }, //OVDE SE RADI ISPIS
                    change: function () {
                        localStorage.setItem("slider", new Array($("#slider-range").slider("values", 0), $("#slider-range").slider("values", 1)));
                        getProducts();
                    }, //OVDE SE RADI ISPIS
                    slide: function (event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                    " - $" + $("#slider-range").slider("values", 1));
            });
        }

        //Reset
        $("#resetFilter").click(() => {

            //Reset slajdera
            //console.log("usao");
            $(function () {
                $("#slider-range").slider({
                    range: true,
                    min: 0,
                    max: 500,
                    values: [0, 500],
                    step: 5,
                    change: function () { ispisProizvoda() }, //OVDE SE RADI ISPIS
                    slide: function (event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                    " - $" + $("#slider-range").slider("values", 1));
            });
            localStorage.setItem("slider", "");

            //Reset diskaunta
            $("#priceRange input[type='checkbox']")[0].checked = false;
            localStorage.setItem("onDiscount", "false");

            //Reset sorta
            $(".filterProducts input[value='default']")[0].checked = true;
            localStorage.setItem("sort", "default");

            //Reset pretrage
            $("#search #term")[0].value = "";
            localStorage.setItem("searchTerm", "");

            //Reset kategorija
            for (let checkbox of $("#filterCategories input[type='checkbox']")) {
                checkbox.checked = false;
            }
            localStorage.setItem("categories", "");

            //Reset brendova
            for (let checkbox of $("#filterBrands input[type='checkbox']")) {
                checkbox.checked = false;
            }
            localStorage.setItem("brands", "");

            getProducts();
        })

        //Brand change
        $(("#filterBrands input")).change(function () {
            let checkedBrands = $("#filterBrands input:checked");
            let checkedBrandIds = new Array();
            for (checkedBrand of checkedBrands) {
                checkedBrandIds.push(checkedBrand.getAttribute("id"));
            }

            localStorage.setItem("brands", checkedBrandIds);

            getProducts();
        })

        //Category change
        $(("#filterCategories input")).change(function () {
            let checkedCategories = $("#filterCategories input:checked");
            let checkedCategoryIds = new Array();
            for (checkedCategory of checkedCategories) {
                checkedCategoryIds.push(checkedCategory.getAttribute("id"));
            }

            localStorage.setItem("categories", checkedCategoryIds);

            getProducts();
        })

        //Pagination Click
        function paginationClick() {
            $("#pagination i").click(function () {
                let pagination = $(this)[0].getAttribute("data-id");
                localStorage.setItem("pagination", pagination);

                //OSVETLI AKTIVAN PAGE
                $("#pagination li[class='active-pagination'").removeClass("active-pagination");
                $(this).parent().addClass("active-pagination");

                //IDI NA VRH PROIZVODA
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#prSize").offset().top - 50
                }, 500);

                getProducts();
            })
        }

        paginationClick();

        //Display Click
        $("#prSize li").click(function () {
            if ($(this)[0].getAttribute("data-id") != 1) {
                localStorage.setItem("displayMethod", $(this)[0].getAttribute("data-id"));
                getProducts();
            }
        })
    }

    //CART ASIDE ISPIS/UPIS

    //Dodavanje osluskivaca za kupovinu
    function addListenerForBuying() {
        $(".productButton").click(function () {
            console.log($(this)[0].getAttribute("data-id"));
            addToCart($(this)[0].getAttribute("data-id"));
            $("#shoppingPopUp").fadeIn("slow");
            setTimeout(function () { $("#shoppingPopUp").fadeOut("slow") }, 3000);
        })
    }

    //Dodavanje proizvod id-a u cart
    function addToCart(id) {
        if (localStorage.getItem("cart") == "") {
            localStorage.setItem("cart", id);
        } else {
            localStorage.setItem("cart", localStorage.getItem("cart") + "," + id);
        }
        getProductsForCart();
        setTimeout(() => writeCartAside(), 200);
    }

    //Dodavanje osluskivaca za uklanjanje iz kupovine
    function addListenerForRemovingItem() {
        $(".removeProduct").click(function () {
            removeFromCart($(this)[0].getAttribute("data-id"));
            getProductsForCart();
            setTimeout(() => writeCartAside(), 200);
        });
    }

    //uklanjanje proizvoda iz carta za 1
    function removeFromCart(id) {
        cartProducts = getWantedProductsFromStorage();
        for (product of cartProducts) {
            if (product[0] == id) {
                product[1] -= 1;
            }
        }

        stringCartProducts = "";
        for (product of cartProducts) {
            if (product[0] == "null") continue;
            if (product[1] == 0) continue;
            for (i = 0; i < parseInt(product[1]); i++) {
                stringCartProducts == "" ? stringCartProducts += product[0] : stringCartProducts += "," + product[0];
            }
        }
        localStorage.setItem("cart", stringCartProducts);
    }
    //dohvatanje proizvoda iz storage-a sa pojavljivanjima
    function getWantedProductsFromStorage() {
        cart = localStorage.getItem("cart");
        cart = cart.split(",");

        productIdInCart = null;
        countOfProductIdInCart = 0;

        helpingArray = new Array;
        var finalArray = new Array;


        if (cart.length == 1) { finalArray.push([cart[0], 1]) };
        for (i = 0; i < cart.length - 1; i++) {
            productIdInCart = cart[i];
            if (helpingArray.includes(cart[i])) continue;
            helpingArray.push(cart[i]);
            for (j = 0; j < cart.length; j++) {
                if (cart[i] == cart[j]) {
                    countOfProductIdInCart++;
                }
            }

            finalArray.push([productIdInCart, countOfProductIdInCart]);
            countOfProductIdInCart = 0;

        }

        if (cart.length > 1 && !helpingArray.includes(cart[cart.length - 1])) {
            finalArray.push([cart[cart.length - 1], 1]);
        }


        //console.log(finalArray); //sada sam dobio dvodimenzioni nizi, gde svaki podniz sadrzi id proizvoda i koliko puta je kupljen

        return finalArray;
    }

    //dohvatanje proizvoda iz baze u localStorage
    function getProductsForCart() {
        if (localStorage.getItem("cart") == "") return;
        cartProducts = getWantedProductsFromStorage();

        cartProductIds = new Array();

        for (cartProduct of cartProducts) {
            cartProductIds.push(cartProduct[0]);
        }

        let data = { "productIds": cartProductIds };
        sendData("../../pages/database/communication/getProductsForCart.php", "get", data,

            function (response) {
                localStorage.setItem("productsForCart", JSON.stringify(response.products));
            },

            function (xhr) {
                console.log(xhr.responseText);
            }
        );
    }

    function getAmmount(id, cartProducts) {
        for (product of cartProducts) {
            if (product[0] == id) return product[1];
        }
    }

    function totalCost(products, cartProducts) {
        let total = 0;
        for (product of products) {
            total += product.new_price * getAmmount(product.id, cartProducts);
        }

        return Math.round(total);
    }


    //ispis u cart aside
    function writeCartAside() {
        let text = `<div class="thumbProduct"><h2>Your Cart</h2></div>`;

        if (localStorage.getItem("productsForCart") != "" && localStorage.getItem("productsForCart") != null && (localStorage.getItem("cart") != "" && localStorage.getItem("cart") != null)) {

            products = JSON.parse(localStorage.getItem("productsForCart"));

            cartProducts = getWantedProductsFromStorage();
            for (product of products) {
                product_name = product.product_name;
                id = product.id;
                text += `
                <div class="thumbProduct">
                    <img src="${getSrcOfProduct(product)}" alt="${product.alt}"/>
                    <p>${product.new_price}$</p>
                    <p>U korpi: ${getAmmount(product.id, cartProducts)}</p>
                    <input type="button" data-Id="${id}" value="Remove" name="remove" class="removeProduct"/>
                    <p>${product_name}</p>
                </div>
                `;
            }

            text += `<div class="thumbProduct" id="checkOut"><h2>Total: ${totalCost(products, cartProducts)}$</h2></div>
            <input type="button" id="checkoutRedirect" value="Get the goodies"/>
            `;

        } else {
            text += `<div class="thumbProduct"><p>Fill it to the Brim !!!<p></div>`;
        }

        $("#cartAside").html(text);
        addListenerForRemovingItem();
        $("#checkoutRedirect").click(function () {
            showPopUp($("#checkout")[0] == undefined ? "logIn" : "checkout");
        });

    }

    //Ispis poruka

    let adminHref = document.location.href.split("/")[document.location.href.split("/").length - 1];

    if (adminHref == "admin.php") {
        $("#userMessages").html(getMessages());
        $("#buttonFooter").click(function(){
            setTimeout(function(){
                $("#userMessages").html(getMessages());
                writeTable($("#selectTableToShow select")[0].value);
            }, 200);
        })
    }

    function getMessages() {
        sendData("../../pages/database/communication/selectMessages.php", "get", null,

            function (response) {
                writeMessages(response.messages);
            },

            function (xhr) {
                message=(JSON.parse(xhr.responseText)).messages
                let text = `
                <h3>User feedback: </h3>
                <div class="userMessage">
                    ${message}     
                </div>
                `;

                $("#userMessages").html(text);
            }
        )
    }

    //Dodavanje osluskivaca za ispis tabele na admin strani
    $("#selectTableToShow select").change(function () {
        writeTable($("#selectTableToShow select")[0].value);
    });

    //Ispis tabele na admin strani
    function writeTable(table) {
        localStorage.setItem("tableChosenForManipulating", table);
        if (table == "default") return;
        let data = {
            "table": table
        };
        sendData("../../pages/database/communication/selectAllFromTable.php", "get", data,

            function (response) {
                writeTableInformation(response.rows);
                addListenerForDeletingFromDatabase();
                addListenerForShowingUpdatingItem();
                
                if (table == "messages") {
                    setTimeout(function(){
                        $("#userMessages").html(getMessages());
                    }, 200);
                }
            },

            function (xhr) {
                console.log(xhr.responseText);
            }
        )
    }

    //Update stavke iz tabele - dodavanje osluskivaca

    function addListenerForShowingUpdatingItem(){
        $("#tableInformationWrapper input[data-action='update']").click(function () {
            localStorage.setItem("idToUpdate", ($(this)[0].getAttribute("data-id")))
            getItemInfo();
            //writeItemInformation();
        });
    }

    //funkcija za ispis informacija o proizvodu koji se update-uje
    function getItemInfo(){
        let table = localStorage.getItem("tableChosenForManipulating");
        let id = localStorage.getItem("idToUpdate");
        console.log(id)
        let data={
            "table":table,
            "id":id
        };

        sendData("../../pages/database/communication/selectSpecificItemInformation.php", "get", data,

            function (response) {
                item=JSON.stringify(response.item);
                categories=JSON.stringify(response.categories);
                brands=JSON.stringify(response.brand);
                
                localStorage.setItem("itemToUpdate", item);

            },

            function (xhr) {
            console.log(xhr.responseText)
            // $("#isDeleted")[0].textContent = JSON.parse(xhr.responseText).message;
            // setTimeout(()=> $("#isDeleted")[0].textContent="", 10000);
            }
        )
    }

    //Brisanje stavke iz tabele - dodavanje osluskivaca

    function addListenerForDeletingFromDatabase() {
        $("#tableInformationWrapper input[data-action='delete']").click(function () {
            deleteItemFromDatabase(($(this)[0].getAttribute("data-id")));
        });
    }

    //Brisanje stavke iz tabele

    function deleteItemFromDatabase(id) {
        table = localStorage.getItem("tableChosenForManipulating");
        let data = {
            "table": table,
            "id": id
        };
        sendData("../../pages/database/communication/deleteIdFromTable.php", "get", data,

            function (response) {
                writeTable(table);
                addListenerForDeletingFromDatabase();
                addListenerForShowingUpdatingItem();
            },

            function (xhr) {
                console.log(JSON.parse(xhr.responseText).message);
                
                $("#isDeleted")[0].textContent = JSON.parse(xhr.responseText).message;
                setTimeout(()=> $("#isDeleted")[0].textContent="", 10000);

            }
        )
    }


    //KRAJ ONLOAD-a
    writeCartAside();
    addListenerForBuying();




    $("#checkoutRedirect").click(function () {
        popup = $("#checkout")[0] == undefined ? "logIn" : "checkout"
        showPopUp($("#checkout")[0] == undefined ? "logIn" : "checkout");
    });

    $("#checkoutButton").click(function () {
        if ($("#address").val() == "" || localStorage.getItem("cart") == "" || localStorage.getItem("cart") == null) {
            $("#isDataValid").text("You must enter something! ");
            setTimeout(() => $("#isDataValid").text(""), 5000);
        } else {
            $("#isDataValid").text("You have successfully purchased your goodies! Thanks for your patronage. ");
            localStorage.removeItem("cart");
            localStorage.removeItem("cartProducts");
            writeCartAside();
            setTimeout(() => document.location.reload(), 2000);
        }
    });

});


//responzive meni
$("#btnMenu").click(function () {
    $("#navMenu ul").toggleClass("show");
});

$("#navMenu ul").click(function () {
    $("#navMenu ul").removeClass("show");
});

//login/register/recovery popup 

function dropPopUp() {
    $(".allScreenPopUp").css("display", "none");
    $(".allScreenPopUp").children().removeClass('visible');
    $(".allScreenPopUp").children().addClass('invisible');
}

var screenWidth;
var screenHeight;

$(window).resize(function () {
    screenWidth = $(window).width();
    screenHeight = $(window).height();

    if (screenWidth < 800) {
        localStorage.setItem("displayMethod", 2);
        writeProducts();
    }

    if ($("#logIn").css('display') == "flex") {
        dropPopUp();
        showPopUp("logIn");
    }

    if ($("#register").css('display') == "flex") {
        dropPopUp();
        showPopUp("register");
    }

    if ($("#recoverPassword").css('display') == "flex") {
        dropPopUp();
        showPopUp("recoverPassword");
    }

    if ($("#showsurvey").css('display') == "flex") {
        dropPopUp();
        showPopUp("showsurvey");
    }

    if ($("#checkout").css('display') == "flex") {
        dropPopUp();
        showPopUp("checkout");
    }
});

function showPopUp(id) {

    screenWidth = $(window).width();
    screenHeight = $(window).height();

    $("#" + id).css({
        'width': screenWidth + 'px',
        'height': screenHeight + 'px',
        'display': 'flex'
    });
    $("#" + id).children().addClass('visible');
    $("#" + id).children().removeClass('invisible');
}

$("#back").click(function () {
    dropPopUp();
});

$(".backToMain").click(function () {
    dropPopUp();

    showPopUp("logIn");
});

$("#navMenu li:contains('Login')").click(function () {
    showPopUp("logIn");
});


$("#goRegister").click(function () {
    dropPopUp();

    showPopUp("register");
});

$("#forgotPassword").click(function () {
    dropPopUp();

    showPopUp("recoverPassword");
});

//Funkcija za proveru required input polja:

function checkRequiredInput(input, span, regex, error1) {
    let check = false;

    if ($(input).val().match(regex)) {
        $(span).html("*")
        check = true;
    } else if ($(input).val() == "") {
        $(span).html("&nbsp; &nbsp; &nbsp; Field is empty.");
        check = false;
    } else {
        $(span).html(error1);
        check = false;
    }

    return check;
}

//Funkcija za proveru optional input polja:

function checkOptionalInput(input, span, regex, error1) {
    let check = false;

    if ($(input).val().match(regex)) {
        $(span).html("")
        check = true;
    } else if ($(input).val() == "") {
        $(span).html("");
        check = true;
    } else {
        $(span).html(error1);
        check = false;
    }

    return check;
}

//REGISTROVANJE KORISNIKA

var reName = /^[A-Z][a-z]{1,11}(\s[A-Z][a-z]{1,11}){1,2}/;
var rePhone = /(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/;
var reEmail = /^\S{1,15}@\S{1,15}$/;
var rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; //mora da ima bar jedno veliko slovo, jedno malo slovo, specijalan znak i broj.

var username = false;
var password = false;
var phone = true;
var email = false;

$("#registerName").blur(function () {
    username = checkRequiredInput("#registerName", "#inputRegisterName", reName, "&nbsp; &nbsp; &nbsp; Word begins with a capital letter followed by a non capital.");
});

$("#registerEmail").blur(function () {
    email = checkRequiredInput("#registerEmail", "#inputRegisterMail", reEmail, "&nbsp; &nbsp; &nbsp; Write the e-mail correctly. Example: name@yahoo.com");
});

$("#registerPhoneNumber").blur(function () {
    phone = checkOptionalInput("#registerPhoneNumber", "#inputRegisterPhone", rePhone, "&nbsp; &nbsp; &nbsp; Wrong phone format. Example: +381648586054. Insert correctly or don't insert at all.");
});

$("#registerPassword").blur(function () {
    password = checkRequiredInput("#registerPassword", "#inputRegisterPassword", rePassword, "&nbsp; &nbsp; &nbsp; Password must be at least 8 characters long and contain 1 of each: Uppercase and lowercase letter, special character and number.");
});

function resetRegister() {
    $("#registerPassword").val("");
    $("#registerPhoneNumber").val("");
    $("#registerEmail").val("");
    $("#registerName").val("");
}

//LOGIN KORISNIKA

function resetLogin() {
    $("#loginEmail").val("");
    $("#loginPassword").val("");
}

var loginEmail = false;
var loginPassword = false;

$("#loginEmail").blur(function () {
    loginEmail = checkRequiredInput("#loginEmail", "#inputLoginEmail", reEmail, "&nbsp; &nbsp; &nbsp; Write the e-mail correctly. Example: name@yahoo.com");
});

$("#loginPassword").blur(function () {
    loginPassword = checkRequiredInput("#loginPassword", "#inputLoginPassword", rePassword, "&nbsp; &nbsp; &nbsp; Password must be at least 8 characters long and contain 1 of each: Uppercase and lowercase letter, special character and number.");
});

//RECOVERY PASSWORDA
recoveryEmail = false;
recoveryPassword = false;

function resetRecovery() {

}

$("#recoveryEmail").blur(function () {
    recoveryEmail = checkRequiredInput("#recoveryEmail", "#inputRecoveryEmail", reEmail, "&nbsp; &nbsp; &nbsp; Write the e-mail correctly. Example: name@yahoo.com");
});

$("#recoveryPassword").blur(function () {
    recoveryPassword = checkRequiredInput("#recoveryPassword", "#inputRecoveryPassword", rePassword, "&nbsp; &nbsp; &nbsp; Password must be at least 8 characters long and contain 1 of each: Uppercase and lowercase letter, special character and number.");
});

//ERROR PAGE BUTTON : RETURN TO INDEX

$("#button-404").click(function () {
    window.location.href = "indexContent.php";
})

//index survey

$("#loginToVote").click(function () {
    showPopUp("logIn");
});

$("#indexShowsurvey").click(function () {
    showPopUp("showsurvey");

    if ($("#surveysHolder label").length == 0) {
        $(".credentialWrapper h4").text("Thank you for answering!");
        $("#submitSurveyAnswers").css("display", "none");
    } else {
        $(".credentialWrapper h4").text("Here are some questions for you:");
    }
});

var selectValues = [];

$("#surveysHolder select").change(function () {
    selects = $("#surveysHolder select");
    selectValues = new Array();
    for (select of selects) {
        selectValues.push([select.name, select.value]);
    }

    let assistantArray = new Array();
    for (combination of selectValues) {
        if (combination[1] == 0) continue;
        assistantArray.push(combination);
    }

    selectValues = assistantArray;
    // surveysArray = new Array();
    // answersArray = new Array();

    // for(combination of assistantArray){
    //     surveysArray.push(combination[0]);
    //     answersArray.push(combination[1]);
    // }

    // selectValues=new Array();
    // selectValues[0]=surveysArray;
    // selectValues[1]=answersArray;

    // selectValues = arrayToJSONObject(selectValues);
});

function arrayToJSONObject(arr) {
    //header
    var keys = arr[0];

    //vacate keys from main array
    var newArr = arr.slice(1, arr.length);

    var formatted = [],
        data = newArr,
        cols = keys,
        l = cols.length;
    for (var i = 0; i < data.length; i++) {
        var d = data[i],
            o = {};
        for (var j = 0; j < l; j++)
            o[cols[j]] = d[j];
        formatted.push(o);
    }
    return formatted;
}


//MAIN SHOP

function writeProducts() {
    text = ``;
    if (localStorage.getItem("products") != null) {

        var products = JSON.parse(localStorage.getItem("products"));
        var displayMethod = localStorage.getItem("displayMethod");

        if (products.length > 0) {
            var i = 0;
            var j = 0;

            for (product of products) {
                if (displayMethod == 3) {
                    if (j == 0) { text += "<div class='row'>" }
                    text += `
                    <div class="col-sm-3">
                    <div class="productInfo">
                    <img src="${getSrcOfProduct(product)}" alt="${product.alt}"/>
                    <p class="zvezde">${writeStars(product.rating)}</p>
                    <h3>${product.brand_name}</h3>
                    <h4>${product.product_name}</h4>
                    <h6>${product.category_name}</h6>
                    <p>${product.new_price}$</p>
                    <s>${product.old_price != null ? product.old_price + "$" : ""}</s>
                    </div>
                    <input type="button" class="productButton" data-id="${product.id}" name="productButton" value="Buy this item"/>
                    </div>
                `;

                    i += 1;
                    j += 1;

                    if (j == 3) {
                        text += "</div>";
                        j = 0;
                    }
                    $("#pagination").css("display", "flex");

                } else if (displayMethod == 2) {

                    text += `
            <div class='row'>
                <div class="col-sm-6">
                    <img src="${getSrcOfProduct(product)}" alt="${product.alt}"/>
                </div>
                <div class="col-sm-6">  
                    <p class="zvezde">${writeStars(product.rating)}</p>
                    <h3>${product.brand_name}</h3>
                    <h4>${product.product_name}</h4>
                    <h6>${product.category_name}</h6>
                    <p>${product.new_price}$</p>
                    <s>${product.old_price != null ? product.old_price + "$" : ""}</s>
                    <input type="button" class="productButton" data-id="${product.id}" name="productButton" value="Buy this item"/>
                </div>
            </div>
            `
                }
            }
            $("#pagination").css("display", "flex");

        } else {
            text += `<div class="row alert-danger"><p>There are currently no products that fit your criteria.<p></div>`;
            $("#pagination").css("display", "none");
        }
    } else {
        text += `<div class="row alert-danger"><p>There are currently no products that fit your criteria.<p></div>`;
        $("#pagination").css("display", "none");
    }
    $("#products").html(text);
}

function getSrcOfProduct(product) {
    var text = `../../assets/images/Products/` + (product.gender == "M" ? "Man" : "Woman") + "/" + product.category_name + "/" + product.src;
    return text;

}
function writeStars(stars) {
    var text = ``;
    for (i = 0; i < stars; i++) {
        text += '<i class="fa fa-star" aria-hidden="true"></i>';
    }
    return text;
}

function ispisProizvoda() {


    uskladisti();
    $(".productButton").click((el) => {
        ispisiCartShop(el.currentTarget.getAttribute("class"), el.currentTarget.getAttribute("data-id"));
        $("#shoppingPopUp").fadeIn("slow");
        setTimeout(function () { $("#shoppingPopUp").fadeOut("slow") }, 3000);
    });

}

//Klik na dugme ispod proizvoda za kupiti
$(".productButton").click((el) => {
    $("#shoppingPopUp").fadeIn("slow");
    setTimeout(function () { $("#shoppingPopUp").fadeOut("slow") }, 2000);
});

//Ispis paginacije:
function writePagination(numberOfProductsPerPage) {

    var text = ``;
    var numberOfProducts = parseInt(localStorage.getItem("numberOfProducts"));
    var numberOfPages = Math.ceil(numberOfProducts / numberOfProductsPerPage);
    var activePage = $("#pagination li[class='active-pagination'] i")[0].getAttribute("data-id");
    activePage = activePage > numberOfPages ? 1 : activePage;

    if (activePage)

        for (i = 0; i < numberOfPages && i < 10; i++) {
            text += `
        <li ${i + 1 == activePage ? "class='active-pagination'" : ""}>
            <i data-id="${i + 1}" class="fa-solid fa-${i + 1}"></i>
        </li>
        `;
        }

    if (numberOfPages == 0) {
        text += `<li class='active-pagination'>
            <i data-id="1">1</i>
        </li>`;
    }
    text = text.toString();
    $("#pagination ul").html(text);
}

//Ispis poruka

function writeMessages(messages) {
    let text = `
        <h3>User feedback: </h3>
    `;

    for (message of messages) {
        text += `
        <div class="userMessage">
            ${message.message}     
        </div>
        `;
    }

    $("#userMessages").html(text);
}

//Ispis tabela

function writeTableInformation(rows) {
    var text = `<table><thead><tr>`;
    if (rows != false) {
        k = 0;

        columns = Object.keys(rows[0])
        for (column of columns) {
            text += `<th>` + column + `</th>`;
        }

        text += `
            <th>EDIT</th>
            <th>DELETE</th></tr></thead><tbody>
        `;

        for (row of rows) {
            text += "<tr>"

            for (column of columns) {
                text += `<td>` + row[column] + `</td>`;
            }

            text += localStorage.getItem("tableChosenForManipulating") == "users" ? "<td>FORBIDDEN</td>" : `<td><input type="button" data-action="update" data-id="${row.id}" value="EDIT"/></td>`;

            text += `
            <td><input type="button" data-action="delete" data-id="${row.id}" value="DELETE"/></td>
            `;

            text += `</tr>`
        }

        text += `</tbody></table>`;
    } else {
        text = "There are no items left in this table";
    }

    $("#tableInformationWrapper").html(text);
    $("#tableInformationWrapper").css("display", "inherit");

}

function writeItemInformation(){

}