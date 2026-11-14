import '../css/app.css'; 

// Auto-register all Stimulus controllers
const controllers = import.meta.glob("./controllers/**/*_controller.js", { eager: true })

for (const path in controllers) {
    const module = controllers[path]
    const name = path
        .match(/\.\/controllers\/(.+)_controller\.js$/)[1]
        .replaceAll("/", "--")
        .replaceAll("_", "-")

        Stimulus.register(name, module.default)
}