const submit = document.querySelector(".form__submit");
submit.addEventListener('click', () => {
    const name_input = document.querySelector(".form__input[name='name']");
    const password_input = document.querySelector(".form__input[name='password']");
    const description = document.querySelector(".form__description");

    const name = name_input.value;
    const password = password_input.value;

    const form = document.querySelector(".form");
    const url = form.action;

    const data = {
        name: name,
        password: password
    };

    $.ajax({
        data: data,
        method: "POST",
        url: url,
        success: (callback) => {
            console.log(callback);
            console.log(form.success);
            if(callback == 'ok') document.location = "./products";
            const errors = callback.split("|");
            name_input.classList.remove("error");
            password_input.classList.remove("error");
            errors.forEach((error) => {
                if(error == 'empty_name') {
                    name_input.classList.add("error");
                    description.innerHTML = "Введите имя";
                }

                if(error == 'empty_password') {
                    password_input.classList.add("error");
                    description.innerHTML = "Введите пароль";
                }

                if(error == 'wrong_password') {
                    console.log(123);
                    name_input.classList.add("error");
                    password_input.classList.add("error");
                    description.innerHTML = "Неверное имя пользователя или пароль";
                }
            });
        }
    });

});