import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="game-filters"
export default class extends Controller {
    static classes = [ "hidden" ]
    static targets = [ "panel", "button", "loader", "results"]

    connect() {
        this.checkParams()
    }

    checkParams() {
        const url = new URL(window.location.href)
        const params = new URLSearchParams(url.search)

        if (params.has('filter[developers][]') ||
            params.has('filter[genres][]') ||
            params.has('filter[platforms][]')
        ) {
            this.panelTarget.classList.remove(this.hiddenClass)
        }
    }

    toggle() {
        this.panelTarget.classList.toggle(this.hiddenClass)
    }

    loading() {
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
        this.loading()
    }
}
