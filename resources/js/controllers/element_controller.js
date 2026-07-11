import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="element"
export default class extends Controller {
    static targets = [ "element" ]
    static classes = [ "hidden" ]

    click() {
        this.elementTarget.click();
    }

    toggle() {
        this.elementTarget.classList.toggle(this.hiddenClass)
    }

    show() {
        this.elementTarget.classList.remove(this.hiddenClass)
    }

    hide() {
        this.elementTarget.classList.add(this.hiddenClass)
    }
}
