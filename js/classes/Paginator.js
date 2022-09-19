import $ from "jquery";

export default class Paginator {

    /**
     * @param {jQuery} container
     * @param {function} action
     */
    constructor(
        container,
        action
    ) {
        this.container = container;
        this.action = action;
        this.pageLineSize = 5;
        this.maxPages = 5;
        this.selectedPageNumber = 1;
    }

    update() {
        this.container.empty();
        let paginatorRadius = Math.floor(this.pageLineSize / 2);
        let pagePosition = this.selectedPageNumber - paginatorRadius;
        if (pagePosition < 1) {
            pagePosition = 1;
        }
        let pageCount = 1;
        while (
            pagePosition <= this.maxPages
            && pageCount <= this.pageLineSize
            ) {
            this.container.append(
                this.renderPageLink(
                    pagePosition,
                    pagePosition === this.selectedPageNumber
                )
            );
            pagePosition++;
            pageCount++;
        }

        if (this.selectedPageNumber < this.maxPages) {
            this.container.append(
                $("<a>", {"href": ""})
                    .append("Next&nbsp;>>")
                    .on("click", (event) => {
                        this.selectedPageNumber++;
                        this.update();
                        this.action(this.selectedPageNumber);
                        return false;
                    })
            );
        }
    }

    /**
     * @param pageNumber
     * @param selected
     * @return {*|jQuery}
     */
    renderPageLink(
        pageNumber,
        selected = false
    ) {
        return $("<a>", {"href": "", "class": selected ? "selected" : ""})
            .append(pageNumber)
            .on("click", {"pagePosition": pageNumber}, (event) => {
                this.selectedPageNumber = pageNumber;
                this.update();
                this.action(pageNumber);
                return false;
            });
    }
}