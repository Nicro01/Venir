<script>
import Navbar from "@/Components/Navbar.vue";
import Hero from "@/Components/Hero.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Navbar,
        Hero,
        Footer,
    },
};
</script>

<template>
    <div>
        <Navbar />

        <Hero />

        <Footer />
    </div>
</template>
