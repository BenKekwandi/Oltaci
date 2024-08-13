<template>
    <div class="page">
      <v-main class="ml-16 mr-16 mt-16 pl-16 pr-16">
        <div class="mb-6">
          <h1>{{ $t('Terms and Conditions') }}</h1>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Introduction') }} <br />
            {{ $t(
              `Welcome to Oltaci, located in Bodrum, Turkey. By accessing and using our website and services, you agree to comply with and be bound by the following terms and conditions (“Terms”). Please read these Terms carefully. If you do not agree with any part of these Terms, you must not use our services.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Services') }} <br />
            {{ $t(
              `Oltaci rents boats for fishing purposes. By renting a boat from us, you agree to comply with all applicable laws and regulations, as well as any rules and guidelines provided by Oltaci.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Booking and Payment') }} <br />
            {{ $t(
              `All bookings must be made through our website. Payments are processed via the Iyzico payment gateway. By making a booking, you agree to provide accurate and complete information and to keep this information updated. You also agree to pay all charges incurred by you or any users of your account at the prices in effect when such charges are incurred.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Cancellations and Refunds') }} <br />
            {{ $t(
              `Cancellations must be made [insert cancellation policy]. Refunds, if applicable, will be processed in accordance with our cancellation policy.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Use of the Boats') }} <br />
            {{ $t(
              `You agree to use the boats responsibly and to follow all safety instructions provided by Oltaci. You are responsible for any damage to the boats or equipment caused by your negligence or misuse.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Limitation of Liability') }} <br />
            {{ $t(
              `To the maximum extent permitted by law, Oltaci shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from (a) your use of or inability to use the services; (b) any unauthorized access to or use of our servers and/or any personal information stored therein; (c) any interruption or cessation of transmission to or from our services; (d) any bugs, viruses, trojan horses, or the like that may be transmitted to or through our services by any third party; (e) any errors or omissions in any content or for any loss or damage incurred as a result of the use of any content posted, emailed, transmitted, or otherwise made available through the services; and/or (f) the defamatory, offensive, or illegal conduct of any third party.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Changes to the Terms') }} <br />
            {{ $t(
              `We may update our Terms from time to time. We will notify you of any changes by posting the new Terms on this page. You are advised to review these Terms periodically for any changes. Changes to these Terms are effective when they are posted on this page.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Governing Law') }} <br />
            {{ $t(
              `These Terms shall be governed and construed in accordance with the laws of Turkey, without regard to its conflict of law provisions.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Contact Us') }} <br />
            {{ $t(
              `If you have any questions about these Terms, please contact us at`
            ) }} <a href="mailto:oltaci.oltaci.com">{{ $t('oltaci.oltaci.com') }}</a>.
          </p>
        </div>
      </v-main>
      <Footer/>
    </div>
  </template>
  
  <script>
  import Footer from "./../components/layouts/Footer.vue";
  import { useI18n } from "vue-i18n";
  
  export default {
    setup() {
      const { t } = useI18n();
      return { t };
    },
  };
  </script>
  