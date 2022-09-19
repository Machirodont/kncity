import $ from "jquery";

export default class StudentsTable {

    /**
     * @param {jQuery} container
     */
    constructor(
        container,
    ) {
        this.container = container;
    }

    /**
     * @param students
     */
    update(students) {
        this.container.empty();
        students.forEach((student) => {
            this.container.append(this.renderInJquery(this.tableLine(student.name, student.test_name)));
        });
    }

    tableLine(name, test) {
        return {
            "tag": "tr",
            "childs": [
                {
                    "tag": "td",
                    "attr": {
                        "class": "checkbox-column"
                    },
                    "childs": [
                        {
                            "tag": "img",
                            "attr": {
                                "src": "/assets/circle_green_checkmark.svg"
                            }
                        }
                    ]
                },
                {
                    "tag": "td",
                    "childs": [
                        {
                            "tag": "div",
                            "content": test
                        },
                        {
                            "tag": "div",
                            "content": name,
                            "attr": {
                                "class": "student-name"
                            },
                        }
                    ]
                },
                {
                    "tag": "td",
                    "attr": {
                        "class": "group-column"
                    },
                    "childs": [
                        {
                            "tag": "div",
                            "content": "..."
                        },
                        {
                            "tag": "div",
                            "content": "Default group"
                        }
                    ]
                }
            ]
        }
    }


    renderInJquery(layout) {
        let attr = layout["attr"] ? layout["attr"] : {};
        let j = $("<" + layout["tag"] + ">", attr);
        if (layout["childs"]) {
            layout["childs"].forEach((child) => {
                j.append(this.renderInJquery(child));
            })
        } else {
            j.append(layout["content"])
        }
        return j;
    }
}