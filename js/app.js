import $ from 'jquery';
import User from "./classes/User";
import Paginator from "./classes/Paginator";
import StudentsTable from "./classes/StudentsTable";

let user = new User();
let paginator;
let studentsTable;

window.onload = function () {

    paginator = new Paginator(
        $(".paginationLine"),
        refreshUserList
    );

    studentsTable = new StudentsTable($(".userTable"));

    initLoginButton();
    initLogoutButton();

    user.getAuthToken()
        ? showUserListPage()
        : showLoginPage();
};

function initLoginButton() {
    $("#loginButton").on("click", function (event) {
        $("#loginButton").prop("disabled", "disabled");
        user.login(
            $("#loginInput").val(),
            $("#passInput").val(),
            !!$("#rememberCheckbox").prop("checked"),
            showUserListPage,
            showLoginError
        );
    });
}

function initLogoutButton() {
    $("#logoutButton").on("click", function (event) {
        user.logout(showLoginPage);
    });
}

function showLoginPage() {
    $("#loginButton").removeAttr("disabled");
    $("#error").text('');
    $("#loginInput").val("");
    $("#passInput").val("");
    $("#userListPage").hide();
    $("#loginPage").show();
}

function showUserListPage() {
    $("#loginPage").hide();
    $("#userListPage").show();
    refreshUserList(1);
}

function showLoginError() {
    $("#loginButton").removeAttr("disabled");
    $("#error").text('Ошибка авторизации');
}

function refreshUserList(pageNumber) {
    let pageSize = 5;
    let from = pageSize * (pageNumber - 1);

    $.ajax("/api/users", {
        "dataType ": "json",
        "method": "get",
        "data": {
            "from": from,
            "pageSize": pageSize,
            "auth_token": user.getAuthToken()
        },
        "success": (data) => {
            if (data.err) {
                user.clearAuthTokenCookie();
                showLoginPage();
            } else {
                studentsTable.update(data.students);
                paginator.maxPages = Math.ceil(data.studentsCount / pageSize);
                paginator.update();
            }
        }
    });
}

