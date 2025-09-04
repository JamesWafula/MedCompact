<template>
  <div>
    <v-card tile raised outlined class="pa-2">
      <p class="text-center">Incidents</p>
      <Bar
        :chart-options="chartOptions"
        :chart-data="chartData"
        :chart-id="chartId"
        :dataset-id-key="datasetIdKey"
        :width="width"
        :height="height"
      />
    </v-card>
    {{ ff }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam
    consequatur deserunt voluptatum architecto autem facilis quasi voluptatem
    perspiciatis magnam alias accusantium quos distinctio sint quo, ratione
    tempore ut consequuntur itaque?
  </div>
</template>

<script>
import { Bar } from "vue-chartjs/legacy";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(Title, Tooltip, BarElement, CategoryScale, LinearScale);
export default {
  data() {
    let incident_data = null;

    if (this.$store.state.incident_stats) {
      incident_data = this.$store.state.incident_stats;
    }
    let incident_labels = incident_data.map((item) =>
      item.incident.toLowerCase().replace("events", "")
    );
    let incident_info = incident_data.map((item) => item.errorCount);
    let bar_color = incident_data.map(() => randomColor());

    return {
      ff: randomColor(),
      chartData: {
        labels: incident_labels,
        datasets: [
          {
            data: incident_info,
            backgroundColor: bar_color,
          },
        ],
      },
      chartOptions: {
        responsive: true,
      },
    };
  },
  components: { Bar },
  props: {
    chartId: {
      type: String,
      default: "bar-chart",
    },
    datasetIdKey: {
      type: String,
      default: "label",
    },
    width: {
      type: Number,
      default: 400,
    },
    height: {
      type: Number,
      default: 300,
    },
  },
};
</script>
