document.addEventListener("DOMContentLoaded", () => {
    if(document.querySelector(".burger")) {
        const burger = document.querySelector(".burger a"),
            cancel = document.querySelector(".cancel_burger"),
            blackFon = document.querySelector(".black_fon"),
            nav = document.querySelector(".header_nav")

        function cancelBurger(e) {
            e.preventDefault()
            blackFon.style.display = "none"
            nav.style.left = '-100%'
        }

        burger.addEventListener("click", () => {
            blackFon.style.display = "block"
            nav.style.left = '0'
        })

        // nav.querySelectorAll('ul li').forEach(item => {
        //     item.addEventListener("click", cancelBurger)
        // })

        cancel.addEventListener("click", (e) => {
            e.preventDefault()
            cancelBurger()
        })
        blackFon.addEventListener("click", (e) => {
            e.preventDefault()
            cancelBurger()
        })
        
    }

    if (document.querySelector(".catalogue_container")) {
        document.addEventListener('click', function (e) {
            const link = e.target.closest('.filter-link')
            if (!link) return

            e.preventDefault()

            const categoryId = link.dataset.category ?? '',
                container = document.querySelector('.catalogue_container')

            document.querySelectorAll('.filter-link')
                .forEach(el => el.classList.remove('active'))
            link.classList.add('active')

            if (categoryId) {
                history.pushState({}, '', `?category=${categoryId}`)
            } else {
                history.pushState({}, '', location.pathname)
            }

            fetch(link.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                // console.log(html);
                container.innerHTML = html
            })
            .catch(err => console.error(err))
        })
    }

    if (document.querySelector('video')) {
        const video = document.querySelector('video');

        function playVideo() {
            video.play();
            document.removeEventListener('click', playVideo);
        }
        document.addEventListener('click', playVideo);
    }

    if (document.querySelector(".form_order")) {
        const form = document.querySelector(".form_order"),
            phoneInput = form.querySelector("input[name='userPhone']"),
            nameInput = form.querySelector("input[name='userName']"),
            errorTel = document.querySelector(".error"),
            errorName = document.querySelector(".errorName"),
            maxLength = 30,
            minLength = 3

        phoneInput.addEventListener("focus", function () {
            if (!phoneInput.value.startsWith("+380")) {
                phoneInput.value = "+380"
            }
        })

        phoneInput.addEventListener("input", function () {
            let inputValue = phoneInput.value,
                cleanedValue = inputValue.replace(/[^\d+]/g, "")

            if (!cleanedValue.startsWith("+380")) {
                cleanedValue = "+380" + cleanedValue.slice(3)
            }

            if (cleanedValue.length > 13) {
                cleanedValue = cleanedValue.slice(0, 13)
            }

            phoneInput.value = cleanedValue

            const validInput = isValidPhoneNumber(cleanedValue)

            if (validInput) {
                phoneInput.style.borderColor = 'green'
                phoneInput.style.color = '#121212'
                errorTel.style.display = "none"
            } else {
                phoneInput.style.borderColor = '#EB4242'
                phoneInput.style.color = '#EB4242'
                errorTel.style.display = "block"
            }
        })


        form.addEventListener("submit", (e) => {
            const phone = phoneInput.value.trim(),
                name = nameInput.value.trim()

            let valid = true

            if (!phone || !isValidPhoneNumber(phone) || phone.length < 13) {
                errorTel.style.display = "block"
                phoneInput.style.borderColor = '#EB4242'
                valid = false
            } else {
                errorTel.style.display = "none"
                phoneInput.style.borderColor = 'green'
            }

            if (name.length < minLength || name.length > maxLength) {
                errorName.style.display = "block"
                nameInput.style.borderColor = '#EB4242'
                valid = false
            } else {
                errorName.style.display = "none"
                nameInput.style.borderColor = 'green'
            }

            if (!valid) {
                console.log("+");
                e.preventDefault()
            }
        })

        function isValidPhoneNumber(phoneNumber) {
            return /^\+380\d{9}$/.test(phoneNumber)
        }
    }

})