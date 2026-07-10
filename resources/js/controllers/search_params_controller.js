import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="search-params"
export default class extends Controller {
    static targets = [ "anchor" ]
    static values = {
        paramKey: String,
        elementId: String
    }

    addFromElement() {
        let e = document.getElementById(this.elementIdValue)
        let value = e.value

        let anchor = this.anchorTarget
        anchor.search = new URLSearchParams({ [this.paramKeyValue]: value })

        this.dispatch("added")
    }
}