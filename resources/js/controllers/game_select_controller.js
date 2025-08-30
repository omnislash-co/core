import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="game-select"
export default class extends Controller {
    static classes = [ "hidden" ]
    static targets = [ "input", "menu", "item", "anchor", "select", "loader", "results" ]
    static values = {
        hasResults: { type: Boolean, default: true },
        searchParam: { type: String, default: "game" }
    }

    connect() {
        if (this.selectTarget.selectedIndex > 0) {
            let event = { 
                target: {
                    id: this.selectTarget.selectedOptions[0].value,
                    textContent: this.selectTarget.selectedOptions[0].textContent
                }
            }
            this.set(event)
        }
    }

    showMenu() {
        this.menuTarget.classList.remove(this.hiddenClass)
    }

    hideMenu() {
        setTimeout(() => {
            this.menuTarget.classList.add(this.hiddenClass)
        }, "120")
    }

    search(event) {
        let input = event.currentTarget.value.toLowerCase().trim()

        if(input.length > 0) {
            this.itemTargets.forEach(element => {
                element.innerText.toLowerCase().includes(input) ? element.classList.remove(this.hiddenClass) : element.classList.add(this.hiddenClass)
            });
        } else {
            this.itemTargets.map(x => x.classList.remove(this.hiddenClass))
        }
    }

    loading() {
        this.loaderTarget.classList.remove(this.hiddenClass)
        this.resultsTarget.classList.add(this.hiddenClass)
    }

    loaded() {
        this.loaderTarget.classList.add(this.hiddenClass)
        this.resultsTarget.classList.remove(this.hiddenClass)
    }

    prep(event) {
        this.encode(event)
        this.set(event)
    }

    encode({ target: { id } }) {
        let anchor = this.anchorTarget
        
        anchor.search = new URLSearchParams({ [this.searchParamValue]: id })
        anchor.click()
        this.loading()
    }
    
    set(event) {
        let input = this.inputTargets.find(element => element.id === 'read-only')
        input.firstElementChild.textContent = event.target.textContent
        input.classList.remove(this.hiddenClass)

        let search = this.inputTargets.find(element => element.id === 'search')
        search.classList.add(this.hiddenClass)

        this.selectTarget.value = event.target.id
    }

    unset() {
        let input = this.inputTargets.find(element => element.id === 'read-only')
        input.classList.add(this.hiddenClass)

        let search = this.inputTargets.find(element => element.id === 'search')
        search.classList.remove(this.hiddenClass)

        this.selectTarget.selectedIndex = 0

        if (this.hasResultsValue) {
            this.anchorTarget.search = ''
            this.anchorTarget.click()
            this.loading()
        }
    }
}
