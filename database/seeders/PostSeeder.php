<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'Tìm hiểu setState() trong Reactjs',
            'hashtag' => '#reactjs',
            'like' => '100',
            'image' => 'uploads/post/react.png',
            'user_id' => '2',
            'content'=>'<p>Compnent state là cách lưu trữ, xử lý và sử dụng thông tin bên trong một Component nhất định và cho phép bạn thực hiện logic của nó. State thường là một POJO (Đối tượng Java [Script] thuần túy), và thay đổi nó là một trong số ít cách để tạo Component tự re-render lại.</p><p>Đây là một trong những ý tưởng cơ bản nhất đằng sau React, tuy nhiên nó có một số thuộc tính khiến nó khó sử dụng và có thể dẫn đến hành vi không mong muốn trong ứng dụng của bạn.</p><h2><strong>1. Cập nhật state</strong></h2><p>Nơi bạn có thể viết trực tiếp this.state phải là hàm constructor trong Component . Ở tất cả những nơi khác bạn nên sử dụng function this.setState, function này sẽ chấp nhận truyền vào một Object cuối cùng và sẽ được hợp nhất vào state của Component hiện tại.</p><p>Mặc dù về mặt kỹ thuật có thể thay đổi state bằng cách viết this.state trực tiếp, nhưng nó sẽ không dẫn đến việc re-rendering Component với dữ liệu mới và thường dẫn đến sự không nhất quán về trạng thái.</p><h2><strong>2. setState không đồng bộ(*)</strong></h2><p>Thực tế là setState gây ra sự hòa giải (quá trình re-rendering lại Component) là cơ sở của thuộc tính tiếp theo - setState không đồng bộ. Điều này cho phép chúng ta có nhiều lệnh gọi đến setState trong một phạm vi duy nhất và không kích hoạt khi không cần re-rendering toàn bộ Component.</p><h2><strong>3. setState chấp nhận một hàm làm tham số của nó.</strong></h2><p>Nếu bạn truyền một hàm làm đối số đầu tiên của setState, React sẽ gọi hàm đó với trạng thái tại thời điểm cuộc gọi hiện tại và muốn bạn trả lại một Object để hợp nhất thành state. Vì vậy, cập nhật lại ví dụ ở trên:</p><p>// giả sử this.state = {value: 0}; this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1}));</p>'
        ]);

        Post::create([
            'title' => 'Tìm hiểu về Service Container trong Laravel',
            'hashtag' => '#laravel',
            'like' => '500',
            'image' => 'uploads/post/laravelservice.png',
            'user_id' => '3',
            'content'=>'<p>Xin chào các anh em, hôm qua mình vừa mới phát hiện ra một điều rất hay trong Laravel mà hôm nay mình muốn lên chia sẻ ngay cho anh em. Thế nhé, mình sẽ tiếp tục series <strong>Laravel và những điều thú vị</strong> thì hôm nay mình sẽ chia sẻ cho anh em về Service Container trong Laravel, nó được dùng khắp nơi trong project của chúng ta luôn nhưng hầu như chúng ta lại không quan tâm nó cho lắm. Cho nên bài viết này mình muốn nói ra những điều hay ho thú vị về nó cho mọi người nghe. Trước tiên để tìm hiểu về Service Container thì chúng ta sẽ tìm hiểu qua một dưới đây trước nhá.</p><h2><strong>1.Denpendency Injection &amp; Inversion of Control</strong></h2><p>Trước tiên chúng ta cần phân biệt 3 khái niệm sau đây nhé:</p><p>Denpendency Inversion: là một nguyên lý thiết kế và viết code.</p><p>Inversion of Control: Đây là một design partern nằm trong nguyên lý SOLID, nó được tạo ra để tuân thủ theo nguyên lý Denpendency Inversion. Có rất nhiều cách để thực hiện partern này, Dependency Inversion là một trong số những cách đó.</p><p>Dependency Injection: Đây là một design partern để thực hiện Inversion of Control. Dependency Injection là cách tổ chức source code, sao cho có thể inject (tiêm) các đối tượng dependency vào trong đối tượng mà nó dependent. Các bạn có thể hiểu đơn giản như này, nếu class A phụ thuộc vào các class khác tức là bên trong class A khởi tạo nhiều đối tượng khác trong đó thì chúng ta có thể truyền những instance của class con đó trong hàm __contruct hoặc hàm setter</p><p>Và nó có 3 kiểu DI:</p><ul><li>Constructor Injection: Các dependency sẽ được container truyền vào (inject vào) 1 class thông qua constructor của class đó. Đây là cách thông dụng nhất.</li><li>Setter Injection: Các dependency sẽ được truyền vào 1 class thông qua các hàm Setter.</li><li>Interface Injection: Class cần inject sẽ implement 1 interface. Interface này chứa 1 hàm tên Inject. Container sẽ injection dependency vào 1 class thông qua việc gọi hàm Inject của interface đó. Đây là cách rườm rà và ít được sử dụng nhất.</li></ul>'
        ]);
    }
}
