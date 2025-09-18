import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="loader"
export default class extends Controller {
    static classes = [ "hidden" ]
    static targets = [ "spinner", "content" ]

    show() {
        this.spinnerTarget.classList.remove(this.hiddenClass)
        this.contentTarget.classList.add(this.hiddenClass)
    }

    hide() {
        this.spinnerTarget.classList.add(this.hiddenClass)
        this.contentTarget.classList.remove(this.hiddenClass)
    }
}
