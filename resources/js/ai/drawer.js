export default function () {
    return {
        open: false,

        loading: false,

        module: null,

        moduleInfo: null,

        data: null,

        init() {
            window.addEventListener("ai:open", (event) => {
                this.module = event.detail.module;

                this.open = true;

                this.loadAI();
            });
        },

        async loadAI() {
            try {
                this.loading = true;

                const response = await fetch(
                    `/ai/analyze?module=${this.module}`,
                );

                const result = await response.json();

                this.data = result.data;
                this.moduleInfo = result.data.module;
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },

        close() {
            this.open = false;
        },
    };
}
