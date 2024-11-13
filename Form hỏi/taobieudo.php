<script>
    function ketqua() {
    // Đổi tiêu đề trang
    document.getElementById("cautieude").innerText = "Kết quả khảo sát";

    // Ẩn phần quản lý câu hỏi
    document.getElementById("quanlycauhoi").style.display = "none";

    // Hiển thị khung chứa biểu đồ
    document.getElementById("charts").style.display = "block";

    // Kiểm tra xem đã tạo biểu đồ chưa
    if (!window.hasCreatedCharts) {  // Sử dụng flag để kiểm tra
        var chartsContainer = document.getElementById("charts");

        // Duyệt qua từng câu hỏi và tạo biểu đồ tròn
        for (var questionId in chartData) {
            if (chartData.hasOwnProperty(questionId)) {
                var data = chartData[questionId];
                
                // Tạo mảng các nhãn và giá trị tương ứng
                var labels = [];
                var counts = [];
                var backgroundColors = [];

                data.forEach(function(answer) {
                    labels.push(answer.label);
                    counts.push(answer.count);
                    backgroundColors.push("#" + Math.floor(Math.random()*16777215).toString(16)); // Màu ngẫu nhiên
                });

                // Tạo phần tử canvas cho biểu đồ
                var canvasId = 'chart_' + questionId;
                var chartDiv = document.createElement('div');
                chartDiv.className = 'chart-container';
                chartDiv.innerHTML = '<h3>Câu hỏi: ' + questionId + '</h3><canvas id="' + canvasId + '" width="400" height="400"></canvas>';
                chartsContainer.appendChild(chartDiv);

                // Tạo biểu đồ tròn
                var ctx = document.getElementById(canvasId).getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor: backgroundColors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ": " + tooltipItem.raw + " câu trả lời";
                                    }
                                }
                            }
                        }
                    }
                });
            }
        }

        // Đánh dấu là đã tạo biểu đồ
        window.hasCreatedCharts = true;
    }
}
</script>