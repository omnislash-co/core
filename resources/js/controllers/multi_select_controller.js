import { Controller } from "@hotwired/stimulus"

// Connects to data-controller="multi-select"
export default class extends Controller {
    static classes = [ "hidden", "active" ]
    static targets = [ "menu", "item", "option" ]
    
    connect() {
    }

    showMenu() {
        this.menuTarget.classList.remove(this.hiddenClass)
    }

    hideMenu() {
        setTimeout(() => {
            this.menuTarget.classList.add(this.hiddenClass)
        }, "120")
    }

    onChange() {
        this.dispatch("on-change")
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

    add(event) {
        let item = event.currentTarget
        let option = this.optionTargets.find(element => element.value === item.innerText)

        item.classList.contains(this.activeClass) ? option.selected = false : option.selected = true
        this.onChange()
    }

    remove(event) {
        let tag = event.currentTarget.parentNode
        let option = this.optionTargets.find(element => element.value === tag.innerText.trim())
        option.selected = false
        this.onChange()
    }
}
