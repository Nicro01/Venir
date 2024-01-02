<script>
import { router } from "@inertiajs/vue3";
import axios from "axios";
import { Input, initTE, Ripple, Animate, Select } from "tw-elements";

export default {
    data() {
        return {
            url: "",
            video: "",
            info: {},
            selectedVideo: "",
            selectedVideoInfo: {},
            videoLoaded: false,
            isLoading: false,
            mediaSelected: 1,
        };
    },
    mounted() {
        initTE({ Input, Ripple, Animate, Select });
    },
    watch: {
        selectedVideo(newValue) {
            this.selectedVideoInfo = this.info[0][newValue];
        },
    },
    methods: {
        _mediaSelected(newValue) {
            if (newValue == this.mediaSelected) {
                return (this.videoLoaded = true);
            } else {
                this.mediaSelected = newValue;
                return (this.videoLoaded = false);
            }
        },
        getEmbedUrl() {
            let videoId = this.url.split("v=")[1];
            let ampersandPosition = videoId.indexOf("&");
            if (ampersandPosition != -1) {
                videoId = videoId.substring(0, ampersandPosition);
            }
            this.video = "https://www.youtube.com/embed/" + videoId;
        },
        async youtube() {
            this.isLoading = true;
            await axios
                .get("/youtube", { params: { url: this.url } })
                .then((response) => {
                    console.log(response);
                    this.info = response.data;
                })
                .finally(() => {
                    this.isLoading = false;
                });

            this.getEmbedUrl();
            this.selectedVideoInfo = this.info[0][0];
            this.videoLoaded = true;
        },
        async reels() {
            this.isLoading = true;
            await axios
                .get("/instagram", { params: { url: this.url } })
                .then((response) => {
                    console.log(response);
                    this.info = response.data[0].items;
                })
                .finally(() => {
                    this.isLoading = false;
                });

            this.video = this.url;
            this.videoLoaded = true;
        },
        async tiktok() {
            this.isLoading = true;
            await axios
                .get("/tiktok", { params: { url: this.url } })
                .then((response) => {
                    console.log(response);
                    this.info = response.data;
                })
                .finally(() => {
                    this.isLoading = false;
                });

            this.video = this.info.videoUrl;
            this.videoLoaded = true;
        },
        download() {
            switch (this.mediaSelected) {
                case 1:
                    this.youtube();
                    break;
                case 2:
                    this.reels();
                    break;
                case 3:
                    this.tiktok();
                    break;
                default:
                    break;
            }
        },
    },
};
</script>
<template>
    <div class="container my-24 mx-auto md:px-6 min-h-screen">
        <!-- Section: Design Block -->
        <section class="mb-32 text-center">
            <div class="flex flex-col gap-10 items-center">
                <div class="max-w-[800px]">
                    <h2
                        class="mb-12 text-4xl text-neutral-600 font-extrabold tracking-tight md:text-4xl xl:text-5xl"
                    >
                        <span
                            class="text-green-600 dark:text-green-400 text-7xl mr-3"
                            id="venir"
                            >Venir</span
                        >
                        Online Video Downloader
                    </h2>
                    <p class="text-lg text-neutral-500 dark:text-neutral-300">
                        Redefining video downloads for YouTube, Twitter,
                        Facebook, and Instagram Reels and Photos. Experience
                        unparalleled simplicity and speed in one powerful
                        platform!
                    </p>
                </div>
                <div class="max-w-[800px]">
                    <div
                        class="relative flex flex-wrap items-stretch w-full sm:w-[400px]"
                    >
                        <input
                            type="text"
                            v-model="url"
                            class="relative w-[70%] sm:w-[80%] m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-green-700 focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-green-700"
                            placeholder="Search for a video url..."
                            aria-label="Search for a video url..."
                            aria-describedby="button-addon2"
                        />
                        <button
                            class="z-[2] inline-block rounded-r bg-green-400 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-green-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:z-[3] focus:bg-green-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,100,0.2),0_4px_18px_0_rgba(59,113,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,100,0.2),0_4px_18px_0_rgba(59,113,100,0.1)]"
                            data-te-ripple-init
                            data-te-animation-start-ref
                            @click="download"
                            type="button"
                            id="button-addon2"
                        >
                            <svg
                                xmlns="https://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2.5"
                                stroke="currentColor"
                                class="w-4 h-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-base mb-5 text-neutral-600">
                        Select a media type
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <button @click="_mediaSelected(1)">
                            <img
                                src="https://i.postimg.cc/s2czq8XR/youtube.png"
                                alt=""
                                class="w-12 h-12"
                                :class="
                                    mediaSelected == 1
                                        ? 'border-2 border-green-400 bg-green-100 rounded-lg  opacity-100'
                                        : 'opacity-50'
                                "
                            />
                        </button>
                        <button @click="_mediaSelected(2)">
                            <img
                                src="https://i.postimg.cc/0QyvsfMK/reels.png"
                                alt=""
                                class="w-12 h-12"
                                :class="
                                    mediaSelected == 2
                                        ? 'border-2 border-green-400 bg-green-100 rounded-lg opacity-100'
                                        : 'opacity-50'
                                "
                            />
                        </button>
                        <button @click="_mediaSelected(3)">
                            <img
                                src="https://i.postimg.cc/26LLgJfz/tiktok.png"
                                alt=""
                                class="w-12 h-12"
                                :class="
                                    mediaSelected == 3
                                        ? 'border-2 border-green-400 bg-green-100 rounded-lg opacity-100'
                                        : 'opacity-50'
                                "
                            />
                        </button>
                    </div>
                </div>

                <div
                    class="max-w-[800px] flex flex-col gap-4 items-center"
                    v-if="isLoading"
                >
                    <div
                        class="inline-block h-8 w-8 animate-[spinner-grow_0.75s_linear_infinite] rounded-full bg-current align-[-0.125em] opacity-0 motion-reduce:animate-[spinner-grow_1.5s_linear_infinite]"
                        role="status"
                    >
                        <span
                            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                            >Loading...</span
                        >
                    </div>
                </div>

                <div
                    v-if="videoLoaded && mediaSelected == 1"
                    :key="videoLoaded"
                    id="manually-example"
                    class="max-w-[1200px] mt-10"
                    data-te-animation-init
                    data-te-animation-start="manually"
                    data-te-animation-reset="true"
                    data-te-animation="[browse-in_0.5s]"
                >
                    <div
                        class="origin-[center_center] mx-auto grid gap-20 grid-cols-1 sm:grid-cols-3 sm:w-full items-center justify-center"
                    >
                        <div class="col-span-1">
                            <iframe
                                :src="video"
                                frameborder="0"
                                class="rounded-lg shadow-lg h-[200px] sm:h-[350px] w-fit sm:w-[400px]"
                            ></iframe>
                        </div>
                        <div class="col-span-2">
                            <div class="flex flex-col gap-2 mb-10">
                                <span
                                    class="text-sm text-neutral-500 dark:text-neutral-300"
                                >
                                    Channel
                                </span>
                                <span
                                    class="text-lg text-neutral-700 dark:text-neutral-200"
                                >
                                    {{ this.info[1]["channelTitle"] }}
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Title
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info[1]["title"] }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Description
                                    </span>
                                    <p
                                        class="text-lg text-neutral-700 dark:text-neutral-200 text-ellipsis overflow-hidden max-h-20"
                                    >
                                        {{ this.info[1]["description"] }}
                                    </p>
                                    <span
                                        class="text-sm text-neutral-400 dark:text-neutral-300 cursor-pointer"
                                    >
                                        see more
                                    </span>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Views
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info[1]["viewCount"] }}
                                    </span>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text -sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Quality
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        <select
                                            data-te-select-init
                                            class="rounded-lg border-neutral-300 bg-transparent bg-clip-padding px-6 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                                            v-model="selectedVideo"
                                        >
                                            <option
                                                v-for="(info, index) in info[0]"
                                                :key="index"
                                                :value="index"
                                            >
                                                <span
                                                    v-if="
                                                        info.audioQuality !=
                                                            null &&
                                                        info.qualityLabel !=
                                                            null
                                                    "
                                                    >{{
                                                        info.qualityLabel
                                                    }}</span
                                                >
                                                <span
                                                    v-else-if="
                                                        info.qualityLabel !=
                                                        null
                                                    "
                                                    >{{ info.qualityLabel }} No
                                                    Audio</span
                                                >
                                                <span v-else
                                                    >{{ info.quality }} Only
                                                    Audio</span
                                                >
                                            </option>
                                        </select>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        type="button"
                        class="inline-block mt-10 px-10 rounded border-2 border-success pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-success transition duration-150 ease-in-out hover:border-success-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-success-600 focus:border-success-600 focus:text-success-600 focus:outline-none focus:ring-0 active:border-success-700 active:text-success-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                        data-te-ripple-init
                        :href="this.selectedVideoInfo['url']"
                        target="_blank"
                    >
                        DOWNLOAD
                    </a>
                </div>
                <div
                    v-if="videoLoaded && mediaSelected == 2"
                    :key="videoLoaded"
                    id="manually-example"
                    class="max-w-[1200px] mt-10"
                    data-te-animation-init
                    data-te-animation-start="manually"
                    data-te-animation-reset="true"
                    data-te-animation="[browse-in_0.5s]"
                >
                    <div
                        class="origin-[center_center] mx-auto grid gap-20 grid-cols-1 sm:grid-cols-3 sm:w-full items-center justify-center"
                    >
                        <div class="col-span-1">
                            <video controls class="rounded-lg shadow-lg">
                                <source
                                    :src="this.info[0].video_versions[0].url"
                                    type="video/webm"
                                />
                            </video>
                        </div>
                        <div class="col-span-2">
                            <div class="flex flex-col gap-2 mb-10">
                                <span
                                    class="text-sm text-neutral-500 dark:text-neutral-300"
                                >
                                    User
                                </span>
                                <span
                                    class="text-lg text-neutral-700 dark:text-neutral-200"
                                >
                                    @{{ this.info[0].user.username }}
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Full Name
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info[0].user.full_name }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Description
                                    </span>
                                    <p
                                        class="text-lg text-neutral-700 dark:text-neutral-200 text-ellipsis overflow-hidden max-h-20"
                                    >
                                        {{ this.info[0].caption.text }}
                                    </p>
                                    <span
                                        class="text-sm text-neutral-400 dark:text-neutral-300 cursor-pointer"
                                    >
                                        see more
                                    </span>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Views
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info[0].view_count }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Likes
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info[0].like_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        type="button"
                        class="inline-block mt-10 px-10 rounded border-2 border-success pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-success transition duration-150 ease-in-out hover:border-success-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-success-600 focus:border-success-600 focus:text-success-600 focus:outline-none focus:ring-0 active:border-success-700 active:text-success-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                        data-te-ripple-init
                        :href="this.info[0].video_versions[0].url"
                        target="_blank"
                        :download="`${this.info[0].user.username}.mp4`"
                    >
                        DOWNLOAD
                    </a>
                </div>
                <div
                    v-if="videoLoaded && mediaSelected == 3"
                    :key="videoLoaded"
                    id="manually-example"
                    class="max-w-[1200px] mt-10"
                    data-te-animation-init
                    data-te-animation-start="manually"
                    data-te-animation-reset="true"
                    data-te-animation="[browse-in_0.5s]"
                >
                    <div
                        class="origin-[center_center] mx-auto grid gap-20 grid-cols-1 sm:grid-cols-3 sm:w-full items-center justify-center"
                    >
                        <div class="col-span-1">
                            <video controls class="rounded-lg shadow-lg">
                                <source
                                    :src="this.info.data.wmplay"
                                    type="video/webm"
                                />
                            </video>
                        </div>
                        <div class="col-span-2">
                            <div class="flex flex-col gap-2 mb-10">
                                <span
                                    class="text-sm text-neutral-500 dark:text-neutral-300"
                                >
                                    User
                                </span>
                                <span
                                    class="text-lg text-neutral-700 dark:text-neutral-200"
                                >
                                    @{{ this.info.data.author.unique_id }}
                                </span>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Full Name
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info.data.author.nickname }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Description
                                    </span>
                                    <p
                                        class="text-lg text-neutral-700 dark:text-neutral-200 text-ellipsis overflow-hidden max-h-20"
                                    >
                                        {{ this.info.data.title }}
                                    </p>
                                    <span
                                        class="text-sm text-neutral-400 dark:text-neutral-300 cursor-pointer"
                                    >
                                        see more
                                    </span>
                                </div>

                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Views
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info.data.play_count }}
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-sm text-neutral-500 dark:text-neutral-300"
                                    >
                                        Shares
                                    </span>
                                    <span
                                        class="text-lg text-neutral-700 dark:text-neutral-200"
                                    >
                                        {{ this.info.data.share_count }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        type="button"
                        class="inline-block mt-10 px-10 rounded border-2 border-success pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-success transition duration-150 ease-in-out hover:border-success-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-success-600 focus:border-success-600 focus:text-success-600 focus:outline-none focus:ring-0 active:border-success-700 active:text-success-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                        data-te-ripple-init
                        :href="`${this.info.data.hdplay}.mp4`"
                        target="_blank"
                        :download="`${this.info.data.hdplay}.mp4`"
                    >
                        DOWNLOAD
                    </a>
                </div>
            </div>
        </section>
        <!-- Section: Design Block -->
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Caveat:wght@600&family=Sarabun:wght@300&display=swap");

#venir {
    font-family: "Caveat", cursive;
}
</style>
