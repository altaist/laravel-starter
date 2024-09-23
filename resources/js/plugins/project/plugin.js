import Header from '@/components/shared/Header.vue';
import Footer from '@/components/shared/Footer.vue';
import Section from '@/components/shared/Section.vue';
import SectionTitle from '@/components/shared/SectionTitle.vue';
import Container from '@/components/shared/Container.vue';
import PageContainer from '@/components/shared/PageContainer.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import Btn from '@/components/shared/Btn.vue';
import Panel from '@/components/shared/Panel.vue';

export default {
    install: (app, options) => {
        app.component("page-header", Header);
        app.component("page-footer", Footer);
        app.component("page-section", Section);
        app.component("section-title", SectionTitle);
        app.component("container", Container);
        app.component("page-container", PageContainer);
        app.component("page-title", PageTitle);
        app.component("btn", Btn);
        app.component("panel", Panel);
        app.mixin({
            methods: {
                d(...t){
                    return console.log(...t)
                }
            }
        })
    }
}

