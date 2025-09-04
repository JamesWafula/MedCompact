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
      // option: {
      //   title: {
      //     text: "Outcome",
      //     left: "center",
      //   },
      //   tooltip: {
      //     trigger: "item",
      //     formatter: " {b} : {c}",
      //   },
      //   xAxis: {
      //     type: "category",
      //     data: outcome_labels,
      //     axisLabel: {
      //       rotate: 45,
      //     },
      //   },
      //   yAxis: {
      //     type: "value",
      //   },
      //   series: [
      //     {
      //       data: outcome_info,
      //       type: "bar",
      //     },
      //   ],
      // },
    };
  },
  computed: {
    options() {
      let outcome = null;

      if (this.outcome_data) {
        outcome = this.outcome_data;
      }
      let outcome_labels = outcome.map(
        (item) => item.outcome.toLowerCase().substring(0, 9) + "..."
      );
      let outcome_info = outcome.map((item) => item.errorCount);
      // return outcome_labels;
      return {
        title: {
          text: "Outcome",
          left: "center",
        },
        tooltip: {
          trigger: "item",
          formatter: " {b} : {c}",
        },
        xAxis: {
          type: "category",
          data: outcome_labels,
          axisLabel: {
            rotate: 45,
          },
        },
        yAxis: {
          type: "value",
        },
        series: [
          {
            data: outcome_info,
            type: "bar",
          },
        ],
      };
    },
  },
  props: {
    outcome_data: Array,
  },
};
</script>

<style scoped>
.chart {
  height: 400px;
}
</style>
