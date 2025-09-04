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
    return {};
  },
  computed: {
    options() {
      let location_of_error = null;

      if (this.location_data) {
        location_of_error = this.location_data;
      }
      let location_of_error_labels = location_of_error.map(
        (item) => item.location.toLowerCase().substring(0, 9) + "..."
      );
      let location_of_error_info = location_of_error.map(
        (item) => item.errorCount
      );
      return {
        title: {
          text: "location of error",
          left: "center",
        },

        tooltip: {
          trigger: "item",
          formatter: " {b} : {c}",
        },
        xAxis: {
          type: "category",
          data: location_of_error_labels,
          axisLabel: {
            rotate: 45,
          },
        },
        yAxis: {
          type: "value",
        },
        series: [
          {
            data: location_of_error_info,
            type: "bar",
          },
        ],
      };
    },
  },
  props: {
    location_data: Array,
  },
};
</script>

<style scoped>
.chart {
  height: 400px;
}
</style>
