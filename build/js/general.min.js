window.addEventListener("DOMContentLoaded", () => {

    //Burger Switcher
    function hamburger(){

        const hamburger = document.querySelector('.humburger');
        const mobileMenu = document.querySelector('.mobile-menu');
        const siteHeaderConten = document.querySelector('.site-header-conten');
        const siteHeader = document.querySelector('.site-header');
      
        if (!hamburger) {
          return;
        }
        if (!mobileMenu) {
          return;
        }
        if (!siteHeaderConten) {
            return;
        }
        if(!siteHeader){
            return;
        }
      
        hamburger.addEventListener('click', () => {
          hamburger.classList.toggle('active');
          mobileMenu.classList.toggle('active');
          siteHeaderConten.classList.toggle('active');
          if (!siteHeader.classList.contains('active')) {
            setTimeout(() => {
              siteHeader.classList.add('active');
            }, 800);
          } else {
            siteHeader.classList.remove('active');
          }
        });

    }

    hamburger()
    

    // Heder contact
    document.querySelectorAll('.menu-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const parent = this.parentNode; 
            parent.classList.toggle('activ'); 
    
            const navigationBox = parent.querySelector('.navigation-box'); 
            if (navigationBox) {
                if (navigationBox.style.display === 'block') {
                    navigationBox.style.display = 'none'; 
                } else {
                    navigationBox.style.display = 'block'; 
                }
            }
        });
    });
	
	/** SCROLL TO SECTION **/
	document.querySelectorAll('a[href^="#"]').forEach(link => {
		const btnId = link.getAttribute('href').slice(1); 
	  
		link.addEventListener("click", function(e) {
		  e.preventDefault();
	  
		  const targetSection = document.getElementById(btnId);
		  if (targetSection) {
			targetSection.scrollIntoView({ behavior: "smooth" });
		  }
		});
	  });


	/** Image to SVG **/
	document.querySelectorAll("img.svg").forEach(function (img) {
		var imgID = img.id;
		var imgClass = img.className;
		var imgURL = img.src;
	
		fetch(imgURL)
			.then(function (response) {
				return response.text();
			})
			.then(function (data) {

				var parser = new DOMParser();
				var xmlDoc = parser.parseFromString(data, "image/svg+xml");
				var svg = xmlDoc.querySelector("svg");
	
				if (!svg) {
					console.error("SVG not found in the file:", imgURL);
					return;
				}

				if (imgID) {
					svg.setAttribute("id", imgID);
				}
	
				if (imgClass) {
					svg.setAttribute("class", imgClass + " replaced-svg");
				}
	
				svg.removeAttribute("xmlns:a");
	
				if (!svg.hasAttribute("viewBox") && svg.hasAttribute("height") && svg.hasAttribute("width")) {
					svg.setAttribute(
						"viewBox",
						"0 0 " + svg.getAttribute("width") + " " + svg.getAttribute("height")
					);
				}
				img.replaceWith(svg);
			})
			.catch(function (error) {
				console.error("Error fetching SVG:", error);
			});
	});

    // Animation scroll
    function onEntry(entry) {
        entry.forEach(change => {
        if (change.isIntersecting) {
            change.target.classList.add('aos-animate');
        }
        });
    }
    let options = { threshold: [0.25] };
    let observer = new IntersectionObserver(onEntry, options);
    let elements = document.querySelectorAll('[data-aos="fade-up"]');
    for (let elm of elements) {
        observer.observe(elm);
    }

});

document.addEventListener("DOMContentLoaded", function () {
    let popup = document.getElementById("contact-popup");
    let openBtn = document.getElementById("open-popup");
    let mobileContactBtn = document.getElementById("mobile-contact");
    let closeBtn = document.querySelector(".close-popup");
    let popupOverlay = document.querySelector(".popup-overlay");

    if (popup && popupOverlay) {
        function showPopup() {
            popup.classList.add("show");
            popupOverlay.classList.add("show");
        }

        function hidePopup() {
            popup.classList.remove("show");
            popupOverlay.classList.remove("show");
        }

        if (openBtn) {
            openBtn.addEventListener("click", showPopup);
        }

        if (mobileContactBtn) {
            mobileContactBtn.addEventListener("click", showPopup);
        }

        if (closeBtn) {
            closeBtn.addEventListener("click", hidePopup);
        }

        popupOverlay.addEventListener("click", hidePopup);
    }
});




/**
 * Enables interactive selection of countries from a dropdown-style list with flags, 
 * updating a hidden input for form submission. Users can click the currently 
 * selected country to expand or collapse the list, then choose a different country 
 * to replace the displayed text and update the hidden input value accordingly.
 *
 * Key Features:
 * 1. Toggle Dropdown: Clicking the displayed selected country (with flag) toggles 
 *    the visibility of the country list.
 * 2. Update Selection: When a user picks a country from the list, the hidden input field 
 *    (used by Contact Form 7 or other forms) is updated with the new value, and the 
 *    displayed text changes to show the chosen country's name and flag.
 * 3. Click Outside to Close: Clicking anywhere outside the country list closes the list 
 *    if it is currently expanded, providing a seamless user experience.
 */
document.addEventListener("DOMContentLoaded", function () {
    let countryList = document.querySelector(".custom-country-list");
    let countryItems = document.querySelectorAll(".custom-country-list li");
    let hiddenInput = document.getElementById("selected-country");
    let selectedText = document.querySelector(".selected-country");

    if (countryList) {
        selectedText.addEventListener("click", function () {
            countryList.classList.toggle("active");
        });

        countryItems.forEach(item => {
            item.addEventListener("click", function () {
                let selectedCountry = this.getAttribute("data-country");
                let flagSrc = this.querySelector("img").src;

                hiddenInput.value = selectedCountry;
                countryList.classList.remove("active");
                selectedText.innerHTML = '<img src="' + flagSrc + '" class="flag-icon"> ' + selectedCountry;
            });
        });

        document.addEventListener("click", function (event) {
            if (!countryList.contains(event.target)) {
                countryList.classList.remove("active");
            }
        });
    }
});


document.addEventListener('DOMContentLoaded', function () {

    // Активация label при фокусе/блюре для всех input и textarea
    document.querySelectorAll('input, textarea').forEach(element => {
        const formRow = element.closest('.contact-form__row, .sidebar-contact-form__row');
        if (!formRow) return;

        const label = formRow.querySelector('.contact-form__label, .sidebar-contact-form__label, .textarea-label, .sidebar-textarea-label');
        if (!label) return;

        addEvents(element, label);
    });

    function addEvents(element, label) {
        element.addEventListener('focus', () => label.classList.add('active'));
        element.addEventListener('blur', () => {
            if (!element.value.trim()) {
                label.classList.remove('active');
            }
        });
        if (element.value.trim()) {
            label.classList.add('active');
        }
    }

    // Обработка чекбокса политики принятия (если он присутствует)
    document.querySelectorAll("form").forEach(form => {
        const submitButton = form.querySelector(".wpcf7-submit");
        const acceptanceCheckbox = form.querySelector("input[name='acceptance-policy']");
        const acceptanceError = form.querySelector(".contact-form__error-message");

        if (!submitButton) return; // если нет кнопки отправки, пропускаем

        if (acceptanceCheckbox) {
            submitButton.removeAttribute("disabled");

            acceptanceCheckbox.addEventListener("change", function () {
                if (acceptanceCheckbox.checked) {
                    acceptanceError.style.display = "none";
                }
            });

            submitButton.addEventListener("click", function (event) {
                if (!acceptanceCheckbox.checked) {
                    event.preventDefault();
                    acceptanceError.style.display = "block";
                }
            });
        }
    });

    // Обработка события успешной отправки формы
    document.addEventListener('wpcf7mailsent', function (event) {
        let form = event.target.closest("form");
        if (!form) return;

        // Ищем сообщение в зависимости от формы: может быть как в попапе, так и в футере
        let messageBox = form.querySelector('.contact-form__message, .sidebar-contact-form__message');
        let messageText = form.querySelector('#formMessageText, #sidebarFormMessageText, #bottomFormMessageText');

        if (messageBox && messageText) {
            messageBox.style.display = "block";
            messageBox.style.position = "absolute";
            messageBox.style.bottom = "0";
            messageBox.style.right = "0";
            messageBox.style.left = "0";
            messageBox.style.textAlign = "center";
            messageBox.style.backgroundColor = "rgb(8, 190, 178)";
            messageBox.style.color = "#ffffff";
            messageBox.style.padding = "10px";
            messageBox.style.borderRadius = "5px";
            messageText.innerHTML = "Your message has been sent successfully! <br> We will get back to you soon.";

            setTimeout(() => {
                messageBox.style.display = "none";
            }, 5000);
        }
    });

    // Обработка событий ошибки (невалидные данные, спам, ошибка отправки)
    document.addEventListener('wpcf7invalid', showErrorMessage);
    document.addEventListener('wpcf7spam', showErrorMessage);
    document.addEventListener('wpcf7mailfailed', showErrorMessage);

    function showErrorMessage(event) {
        let form = event.target.closest("form");
        if (!form) return;

        let messageBox = form.querySelector('.contact-form__message, .sidebar-contact-form__message');
        let messageText = form.querySelector('#formMessageText, #sidebarFormMessageText, #bottomFormMessageText');

        if (messageBox && messageText) {
            messageBox.style.display = "flex";
            messageBox.style.bottom = "0";
            messageBox.style.right = "0";
            messageBox.style.left = "0";
            messageBox.style.textAlign = "center";
            messageBox.style.backgroundColor = "rgb(157, 64, 173)";
            messageBox.style.color = "#ffffff";
            messageBox.style.borderRadius = "5px";
            messageText.innerHTML = "There was an error submitting the form. <br> Please check all fields and try again.";

            setTimeout(() => {
                messageBox.style.display = "none";
            }, 5000);
        }
    }
});
