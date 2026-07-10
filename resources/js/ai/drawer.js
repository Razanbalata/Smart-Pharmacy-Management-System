export default function () {
    return {
        open: false,

        loading: false,

        module: null,

        title: null,

        data: null,

        generatedAt: null,

        init() {
            window.addEventListener("ai:open", (event) => {
                this.module = event.detail.module;

                const titles = {
                    dashboard: "Dashboard Analysis",

                    products: "Products Intelligence",

                    sales: "Sales Intelligence",

                    suppliers: "Supplier Analysis",
                };

                this.title = titles[this.module] ?? "AI Analysis";

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
