import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="element"
export default class extends Controller {
    static targets = [ "button" ]

    click() {
        this.buttonTarget.click();
    }
}
