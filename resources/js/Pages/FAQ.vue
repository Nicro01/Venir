<script>
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

export default {
    components: {
        Navbar,
        Footer,
    },
};
</script>
<template>
    <Navbar />
    <!-- Container for demo purpose -->
    <div class="container my-24 mx-auto md:px-6">
        <!-- Section: Design Block -->
        <section class="mb-32">
            <!-- Jumbotron -->
            <div class="container mx-auto text-center lg:text-left xl:px-32">
                <div class="flex grid items-center lg:grid-cols-2">
                    <div class="mb-12 lg:mb-0">
                        <div
                            class="block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.55)] dark:shadow-black/20 md:px-12 lg:-mr-14 backdrop-blur-[30px]"
                        >
                            <h3 class="mb-3 text-2xl font-bold">
                                Your time is valuable
                            </h3>
                            <h5
                                class="mb-12 text-lg font-bold text-green-500 dark:text-primary-400 lg:mb-10 xl:mb-12"
                            >
                                Let me answer your questions
                            </h5>

                            <p class="mb-4 font-bold">
                                How do I download a video using Venir?
                            </p>
                            <p class="mb-6 text-gray-500 dark:text-neutral-300">
                                To download a video using Venir, simply copy the
                                URL of the video from YouTube, Twitter, or
                                Instagram and paste it into the designated field
                                in the Venir application. Click 'Download,' and
                                enjoy the simplicity of fast and easy video
                                downloads.
                            </p>

                            <p class="mb-4 font-bold">
                                Does Venir offer any options for video quality
                                and formats during the download process?
                            </p>
                            <p class="mb-6 text-gray-500 dark:text-neutral-300">
                                Certainly! Venir provides customizable settings
                                for video quality and formats, allowing you to
                                tailor your downloads according to your
                                preferences. Choose the resolution and format
                                that best suits your needs for an enhanced
                                viewing experience.
                            </p>

                            <p class="mb-4 font-bold">
                                Is Venir completely free to use, or are there
                                any subscription fees?
                            </p>
                            <p class="text-gray-500 dark:text-neutral-300">
                                Venir is entirely free to use, offering a
                                comprehensive set of features for video
                                downloading without any subscription fees. Enjoy
                                a user-friendly and cost-free experience for all
                                your YouTube, Twitter, and Instagram video
                                downloads.
                            </p>
                        </div>
                    </div>

                    <div>
                        <img
                            src="https://img.freepik.com/vetores-gratis/fundo-modelado-3d-abstrato_53876-116127.jpg?w=740&t=st=1704169856~exp=1704170456~hmac=31e77f9aa4fce7022fc525377b1cc8372fc45dea8419744e9dfe59638cf366ed"
                            class="w-full rounded-lg shadow-lg dark:shadow-black/20"
                            alt=""
                        />
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->
        </section>
        <!-- Section: Design Block -->
    </div>
    <!-- Container for demo purpose -->
    <Footer />
</template>
