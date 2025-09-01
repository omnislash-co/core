import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="tabs"
export default class extends Controller {
    static classes = [ "active", "hidden" ]
    static targets = [ "tab", "panel" ]
    static values = {
        defaultTab: String
    }

    connect() {
        // hide all panels
        this.panelTargets.map(x => x.classList.add(this.hiddenClass))

        // activate the selected tab
        let selectedTab = this.tabTargets.find(element => element.id === this.defaultTabValue)
        selectedTab.classList.add(this.activeClass)

        // show the default panel
        let selectedPanel = this.panelTargets.find(element => element.id === this.defaultTabValue)
        selectedPanel.classList.remove(this.hiddenClass)
    }

    select(event) {
        let selectedPanel = this.panelTargets.find(element => element.id === event.currentTarget.id)

        this.tabTargets.map(x => x.classList.remove(this.activeClass)) // deactivate all tabs
        this.panelTargets.map(x => x.classList.add(this.hiddenClass)) // hide all panels

        event.currentTarget.classList.add(this.activeClass) // activate the selected tab
        selectedPanel.classList.remove(this.hiddenClass) // show current panel
    }
}