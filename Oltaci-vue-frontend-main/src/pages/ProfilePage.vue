<template>
    <div class="page">
         <v-main>
           <section class="my-5 bg-grey-lighten-5">
           <v-container fluid style="max-width: 1600px"  class="pt-16" :mobile="sm || xs">
             <v-row>
                 <v-col cols="12" md="10">
                     <v-card class="pa-5 mb-5 custom-card">
                         <v-card-title class="text-h4 text-primary">
                         Profile
                         </v-card-title>
                       
                         <v-card-text>
                         <h6 class="text-h6">{{ $t("Name") }}</h6>
                         <v-text-field
                             class="mb-8"
                             v-model="user.name"
                             outlined
                             variant="outlined"
                         ></v-text-field>
                         <h6 class="text-h6">{{ $t("Surname") }}</h6>
                         <v-text-field
                             class="mb-8"
                             v-model="user.lastname"
                             outlined
                             variant="outlined"
                         ></v-text-field>
                         <h6 class="text-h6">{{ $t("Email") }}</h6>
                         <v-text-field
                             class="mb-8"
                             v-model="user.email"
                             outlined
                             variant="outlined"
                         ></v-text-field>
                         </v-card-text>
                     </v-card>
                 </v-col>
                 
                 <v-col cols="7">
                                <v-text-field v-model="user.name" :label="$t('Name')" variant="outlined" density="comfortable"></v-text-field>

                                <v-text-field v-model="user.lastname" :label="$t('Last Name')" variant="outlined" density="comfortable"></v-text-field>

                                <v-text-field v-model="user.email" :label="$t('Email')" variant="outlined" density="comfortable"></v-text-field>

                                <!-- <v-text-field v-model="boat.width" :label="$t('Width')" variant="outlined" density="comfortable"></v-text-field>

                                <v-textarea v-model="boat.description" :label="$t('Description')" row-height="15" rows="3" variant="outlined" auto-grow></v-textarea>

                                <v-select v-model="boat.type" :label="$t('Type')" :items="['tour', 'fishing']" variant="outlined"></v-select> -->
                </v-col>

                 <v-col cols="12" mt="10">
                     <v-card class="pa-5 mb-5 custom-card">
                         <v-card-title class="text-h4 text-primary">
                         Reservations
                         </v-card-title>
                       
                         <v-data-table :items="memberReservations" :headers="headers" :search="search" class="bg-grey-lighten-5" :mobile="sm || xs"
                             :sort-by="[{ key: 'id', order: 'desc' }]" :loading="loading">
 
                             <template v-slot:item.has_been_paid="{ item }">
 
                                 <v-chip v-if="item.has_been_paid" color="green">
                                     {{ $t('Paid') }}
                                 </v-chip>
                                 <v-chip v-else color="yellow-darken-2">
                                     {{ $t('Pending') }}
                                 </v-chip>
 
                             </template>
                             <!-- <template v-slot:item.actions="{ item }">
                                 <v-btn size="x-small" class="me-2" variant="tonal" icon="mdi-pencil" @click="viewReservation(item)"></v-btn>
                             </template> -->
                         </v-data-table>
 
                     </v-card>
                 </v-col>
             </v-row>
           </v-container>
         </section>
         </v-main>
 
         <Footer />
    </div>
 
 </template>
   
 <script setup>
   import Navbar from "./../components/layouts/Navbar.vue";
   import Footer from "./../components/layouts/Footer.vue";
   import InfoCard from "./../components/base/infoCard.vue";
   import BoatCard from "./../components/base/BoatsCard.vue";
   import RegionCard from "./../components/base/RegionCard.vue";
   import Hero from "./../components/base/Hero.vue";
   import { useAuthStore } from "../stores/auth";
   import { useReservationStore } from "../stores/reservation";
   import { storeToRefs } from "pinia";
   import { ref, onMounted } from "vue";
   import { useI18n } from "vue-i18n";
 
   const { t } = useI18n();
 
   
   const store = useAuthStore();
   const reservationStore = useReservationStore();
 
   const { user, fetchUser } = storeToRefs(store);
   const { memberReservations, fetchMemberReservations } = storeToRefs(reservationStore);
 
   console.log('reservations', memberReservations);
 
   const headers = [
     {
         align: "start",
         key: "id",
         title: "ID",
     },
     { key: "tour.boat.name", title: t('Boat') },
     { key: "departure", title: t('Departure'), value: (item) => `${item.tour.departure.location}, ${item.departure_date}` },
     { key: "return", title: t('Return'), value: (item) => `${item.tour.destination.location}, ${item.return_date}` },
     { key: "total_price", title: t('Total Price') },
     { key: "currency", title: t('Currency') },
     { key: "number_of_people", title: t('Number Of People') },
     { key: 'has_been_paid', title: t('Confirmed') },
     { key: "actions", title: t('Actions'), align: "end", sortable: false },
     ];
 
 
   onMounted(async () => {
   await store.fetchUser();
   console.log('user.id', user.value.id)
   await reservationStore.fetchMemberReservations(user.value.id);
 });
 
 
 
 
 
   
 </script>
   
   <style scoped>
   .hero-section {
     position: relative;
     width: 100%;
     height: 100vh;
     overflow: hidden;
     display: flex;
     align-items: center;
     justify-content: center;
   }
   
   .video-background {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     object-fit: cover;
   }
   
   .overlay {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background: rgba(0, 0, 0, 0.5);
     display: flex;
     align-items: center;
     justify-content: center;
     color: white;
     z-index: 1;
   }
   
   .hero-title {
     font-size: 4rem;
     margin: 0;
   }
   
   .hero-subtitle {
     font-size: 1rem;
     margin-top: 1rem;
   }
   </style>
   