<template>
  <div class="graphChart">
    <v-chart class="chart" :autoresize="true" :option="options" />
  </div>
</template>

<script>
import { use } from "echarts/core";
import { CanvasRenderer } from "echarts/renderers";
import { BarChart, PieChart } from "echarts/charts";
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
} from "echarts/components";
import VChart, { THEME_KEY } from "vue-echarts";

use([
  CanvasRenderer,
  PieChart,
  BarChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
]);

export default {
  name: "HelloWorld",
  components: {
    VChart,
  },
  provide: {
    [THEME_KEY]: "light",
  },
  autoresize: true,
  data() {
    return {
      // tt: incident_labels,
    };
  },
  computed: {
    options() {
      let reporting_location = null;

      if (this.reporting_location_data) {
        reporting_location = this.reporting_location_data;
      }
      let reporting_location_labels = reporting_location.map(
        (item) => item.reportingLocation.toLowerCase().substring(0, 9) + "..."
      );
      let reporting_location_info = reporting_location.map(
        (item) => item.errorCount
      );
      return {
        title: {
          text: "Reporting Location",
          left: "center",
        },

        tooltip: {
          trigger: "item",
          formatter: " {b} : {c}",
        },
        xAxis: {
          type: "category",
          data: reporting_location_labels,
          axisLabel: {
            rotate: 45,
          },
        },
        yAxis: {
          type: "value",
        },
        series: [
          {
            data: reporting_location_info,
            type: "bar",
          },
        ],
      };
    },
  },
  props: {
    reporting_location_data: Array,
  },
};
</script>

<style scoped>
.chart {
  height: 400px;
}
</style>
