import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="game-filters"
export default class extends Controller {
    static classes = [ "hidden" ]
    static targets = [ "panel", "button", "input", "loader", "results"]

    connect() {
    }

    inputOnChange() {
        let icon = this.buttonTargets.find(element => element.id === 'search-arrow')
        this.inputTarget.value.length > 0 ? icon.classList.remove(this.hiddenClass) : icon.classList.add(this.hiddenClass)
    }

    toggle() {
        this.panelTarget.classList.toggle(this.hiddenClass)
    }

    loading(event) {
        this.loaderTarget.classList.remove(this.hiddenClass)
        this.resultsTarget.classList.add(this.hiddenClass)
    }

    loaded() {
        this.loaderTarget.classList.add(this.hiddenClass)
        this.resultsTarget.classList.remove(this.hiddenClass)
    }

    submit() {
        let button = this.buttonTargets.find(element => element.id === 'apply-filters')
        button.click()
    }
}
