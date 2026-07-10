export function openAI(module) {
    window.dispatchEvent(
        new CustomEvent("ai:open", {
            detail: {
                module,
            },
        }),
    );
}
