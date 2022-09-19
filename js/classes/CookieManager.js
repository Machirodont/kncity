export default class CookieManager {

    /**
     *
     * @param {string} cname
     * @param {string} cvalue
     * @param {number} exdays
     */
    setCookie(cname, cvalue, exdays) {
        let expires = "";
        if (typeof exdays === "number") {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            expires = "expires=" + d.toUTCString() + ";";
        }
        document.cookie = cname + "=" + cvalue + ";" + expires + "samesite=strict;";
    }

    /**
     * @param {string} cname
     * @return {string}
     */
    getCookie(cname) {
        return document.cookie
            .split('; ')
            .find((row) => row.startsWith(cname + "="))
            ?.split('=')[1];
    }

    /**
     * @param {string}  cname
     */
    clearCookie(cname) {
        this.setCookie(cname, "", 0);
    }
}