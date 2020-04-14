$(document).ready(function () {

    /**
     * All users for DataTable
     *
     * @returns {[]}
     */
    function allUsers() {
        let dataText = $.ajax({
            type: "GET",
            url: "/user/all",
            async: false,
            data: {type: 'request'},
            dataType: "json",
            error: function () {
                userAlert('alert alert-danger', 'Ошибка! Данные не получены.');
            }
        }).responseText;
        let usersObj = JSON.parse(dataText);
        let usersArray = [];
        for (let [key_1, valueUser] of Object.entries(usersObj)) {
            let skills = '';
            for (let [key_2, valueSkill] of Object.entries(valueUser.skills)) {
                skills += valueSkill.name + ', ';
            }
            usersArray.push([valueUser.id, valueUser.name, valueUser.city.name, skills]);
        }
        return usersArray;
    }

    /**
     * Data and parameters for DataTable
     *
     * @type {{data: *[], columns: [{title: string}, {title: string}, {title: string}, {title: string}], language: {url: string}, order: [number, string]}}
     */
    let tableData = {
        language: {
            "url": "../DataTables/plug-ins/1.10.20/i18n/Russian.json"
        },
        data: allUsers(),
        order: [0,'desc'],
        columns: [
            { title: "#" },
            { title: "Имя" },
            { title: "Город" },
            { title: "Навыки" }
        ]
    };

    /**
     * DataTable init
     *
     * @type {jQuery}
     */
    let table = $('#main_table').DataTable(tableData);

    var form = $('.collapse_form #user-form');

    /**
     * Get new generated user
     */
    $('.collapse_form p').on('click', function () {
        if (form.is(':visible')) {
            form.slideUp()
        } else {
            form.slideDown();
            $.get('/user/new').done(function (data) {
                $('#user-form').find('input[name="name"]').val(data.user);
                $('#user-form').find('input[name="city"]').val(data.city);
            });
        }
    });

    /*
       Sending a post request to create a new user
     */
    $('#create-btn').on('click', function () {
        $.post(
            '/user/create',
            {
                name: $('#user-form').find('input[name="name"]').val(),
                city: $('#user-form').find('input[name="city"]').val()
            }
        ).done(function (data) {

            // Make data for new row
            let skills = '';
            let row = [];
            for (let [key, skill] of Object.entries(data.skills)) {
                skills += skill.name + ', ';
            }
            row = [data.id,data.name,data.city.name,skills];

            // Add new row to table
            table.row.add(row).draw();

            // Close form and show alert
            setTimeout(function () {
                userAlert('alert alert-success', 'Новый сотрудник успешно добавлен');
                form.slideUp();
                $('#user-form').find('input[name="name"]').val('');
                $('#user-form').find('input[name="city"]').val('');
            }, 500)
        }).fail(function () {
            // Alert, if something went wrong
            userAlert('alert alert-danger', 'Данные не сохранились. Произошла ошибка')
        });
    });

    /**
     * creating a notification that appears when ajax request is made
     */
    function userAlert(alert_classes, message) {
        let myAlert = document.getElementsByClassName('alert')[0];
        myAlert.classList = alert_classes;
        myAlert.textContent = message;
        setTimeout(function () {
            myAlert.classList = 'alert';
            myAlert.innerText = '\u00a0';
        }, 3000);
    }
})
;