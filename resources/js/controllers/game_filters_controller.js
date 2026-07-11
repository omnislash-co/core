import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="game-filters"
export default class extends Controller {
    static targets = [ "button"]

    connect() {
        this.checkParams()
    }

    checkParams() {
        const url = new URL(window.location.href)
        const params = new URLSearchParams(url.search)

        if (params.has('filter[developers][]') || params.has('filter[developers][0]') || 
            params.has('filter[genres][]') || params.has('filter[genres][0]') ||
            params.has('filter[platforms][]') || params.has('filter[platforms][0]') ||
            params.has('filter[series][]') || params.has('filter[series][0]')
        ) {
            this.dispatch("has-filters")
        }
    }

    submit() {
        let button = this.buttonTargets.find(element => element.id === 'apply-filters')
        button.click()
    }
}
