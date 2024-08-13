import { ref } from 'vue'
import { defineStore } from 'pinia'
import { getReport, getGeneralReport} from '../http/report-api'


export const useReportStore = defineStore('ReportStore', () => {
    const report = ref([])
    const generalReport = ref([])
    const loading = ref(false)
    const response = ref(null)

    const fetchReport = async () => {

        try {
            const { data } = await getReport();
            report.value = data.data;

        } catch (error) {
            report.value = null;
        }
    }


    const fetchGeneralReport = async () => {

        try {
            const { data } = await getGeneralReport();
            generalReport.value = data.data;

        } catch (error) {
            generalReport.value = null;
        }
    }

    return { report, generalReport, response, loading, fetchReport, fetchGeneralReport }

})
