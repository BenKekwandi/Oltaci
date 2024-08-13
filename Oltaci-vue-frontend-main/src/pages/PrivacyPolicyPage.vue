<template>
    <div class="page">
      <v-main class="ml-16 mr-16 mt-16 pl-16 pr-16">
        <div class="mb-6">
          <h1>{{ $t('Our Privacy Policy') }}</h1>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Introduction') }} <br />
            {{ $t(
              `Welcome to Oltaci, located in Bodrum, Turkey. Oltaci, we are committed to protecting and respecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and rent our boats for fishing. It also describes your rights and choices regarding your information.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Information We Collect') }} <br />
            {{ $t(
              `We may collect and process the following data about you:`
            ) }}
            <br />
            {{ $t('Personal Identification Information') }}: {{ $t('Name, email address, phone number, and payment information.') }}
            <br />
            {{ $t('Technical Data') }}: {{ $t('IP address, browser type and version, time zone setting, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access our website.') }}
            <br />
            {{ $t('Usage Data') }}: {{ $t('Information about how you use our website, products, and services.') }}
            <br />
            {{ $t('Marketing and Communications Data') }}: {{ $t('Your preferences in receiving marketing from us and your communication preferences.') }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('How We Collect Your Information') }} <br />
            {{ $t(
              `We collect information about you in the following ways:`
            ) }}
            <br />
            {{ $t('Direct Interactions') }}: {{ $t(`You may provide us with your Identity, Contact, and Financial Data by filling in forms or by corresponding with us by post, phone, email, or otherwise. This includes personal data you provide when you:`) }}
            <br />
            {{ $t('Rent a boat.') }} <br />
            {{ $t('Subscribe to our newsletter.') }} <br />
            {{ $t('Request marketing to be sent to you.') }} <br />
            {{ $t('Give us feedback or contact us.') }} <br />
            {{ $t('Automated Technologies or Interactions') }}: {{ $t(`As you interact with our website, we may automatically collect Technical Data about your equipment, browsing actions, and patterns. We collect this personal data by using cookies, server logs, and other similar technologies.`) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('How We Use Your Information') }} <br />
            {{ $t(
              `We use the information we collect in the following ways:`
            ) }}
            <br />
            {{ $t('To Process Transactions') }}: {{ $t(`Including renting boats and processing payments through the Iyzico payment gateway.`) }}
            <br />
            {{ $t('To Manage Your Subscriptions') }}: {{ $t(`To send you updates about our services, special offers, and newsletters if you have subscribed.`) }}
            <br />
            {{ $t('To Improve Our Services') }}: {{ $t(`To analyze trends and monitor usage so we can improve our website and services.`) }}
            <br />
            {{ $t('To Communicate With You') }}: {{ $t(`To send administrative information to you for business purposes, including information regarding the website and changes to our terms, conditions, and policies.`) }}
            <br />
            {{ $t('For Marketing and Advertising') }}: {{ $t(`To send you information about our products, services, and promotions, provided you have consented to receiving such information.`) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('How We Share Your Information') }} <br />
            {{ $t(
              `We do not share, sell, or distribute your Personal Information with unrelated third parties, except under these limited circumstances:`
            ) }}
            <br />
            {{ $t('Service Providers') }}: {{ $t(`We may employ third-party companies and individuals to facilitate our Service (“Service Providers”), provide the Service on our behalf, perform Service-related services, or assist us in analyzing how our Service is used.`) }}
            <br />
            {{ $t('Legal Requirements') }}: {{ $t(`We may disclose your Personal Data in the good faith belief that such action is necessary to:`) }}
            <br />
            {{ $t('Comply with a legal obligation.') }} <br />
            {{ $t('Protect and defend the rights or property of Oltaci.') }} <br />
            {{ $t('Prevent or investigate possible wrongdoing in connection with the Service.') }} <br />
            {{ $t('Protect the personal safety of users of the Service or the public.') }} <br />
            {{ $t('Protect against legal liability.') }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Data Security') }} <br />
            {{ $t(
              `We have implemented measures designed to secure your personal information from accidental loss and from unauthorized access, use, alteration, and disclosure. However, the transmission of information via the internet is not completely secure. We cannot guarantee the security of your personal data transmitted to our website; any transmission is at your own risk.`
            ) }}
          </p>
        </div>
        <div class="mb-12">
          <p>
            {{ $t('Your Data Protection Rights') }} <br />
            {{ $t(
              `Depending on your location, you may have the following rights regarding your personal data:`
            ) }}
            <br />
            {{ $t('The right to access') }} – {{ $t('You have the right to request copies of your personal data.') }} <br />
            {{ $t('The right to rectification') }} – {{ $t(`You have the right to request that we correct any information you believe is inaccurate or complete information you believe`) }}
          </p>
        </div>
      </v-main>
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
  