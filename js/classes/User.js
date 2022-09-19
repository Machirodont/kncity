import CookieManager from "./CookieManager";
import $ from "jquery";

export default class User {

    constructor() {
        this.cookie = new CookieManager();
    }

    /**
     * @param {string} authToken
     * @param {boolean} remember
     */
    addAuthTokenCookie(authToken, remember) {
        if (remember) {
            this.cookie.setCookie("auth_token", authToken, 30);
        } else {
            this.cookie.setCookie("auth_token", authToken);
        }
    }

    clearAuthTokenCookie() {
        this.cookie.clearCookie("auth_token");
    }

    getAuthToken() {
        return this.cookie.getCookie('auth_token');
    }

    /**
     * @param {string} username
     * @param {string} pass
     * @param {boolean} rememberMe
     * @param {function} successCallback
     * @param {function} errorCallback
     */
    login(
        username,
        pass,
        rememberMe,
        successCallback,
        errorCallback
    ) {
        $.ajax("/api/auth", {
            "dataType ": "json",
            "method": "post",
            "data": {
                "login": username,
                "pass": pass
            },
            "success": (data) => {
                let authToken = data.auth_token;
                if (authToken) {
                    this.addAuthTokenCookie(authToken, rememberMe);
                    successCallback();
                } else {
                    errorCallback();
                }
            },
            "error": () => {
                errorCallback();
            }
        });
    }

    logout(callback) {
        $.ajax("/api/auth?auth_token=" + this.getAuthToken(), {
            "dataType ": "json",
            "method": "delete",
            "success": (data) => {
                this.clearAuthTokenCookie();
                callback();
            }
        });
    }
}