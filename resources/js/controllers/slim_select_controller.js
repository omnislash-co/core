import { Controller } from "@hotwired/stimulus"
import SlimSelect from 'slim-select'

// Connects to data-controller="slim-select"
export default class extends Controller {
    static values = {
        options: Object,
        placeholder: String
    };

    connect() {
        this.slimselect = new SlimSelect({
            select: this.element,
            ...this.optionsValue,
            events: {
                afterChange: (newVal) => {
                    this.dispatch("after-change")
                }
            },
            settings: {
                placeholderText: this.placeholderValue
            }
        });
    }

    disconnect() {
        this.slimselect.destroy();
    }
}
