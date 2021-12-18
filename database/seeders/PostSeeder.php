<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Question;

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
            'user_id' => '3',
            'content'=>'<p>Compnent state là cách lưu trữ, xử lý và sử dụng thông tin bên trong một Component nhất định và cho phép bạn thực hiện logic của nó. State thường là một POJO (Đối tượng Java [Script] thuần túy), và thay đổi nó là một trong số ít cách để tạo Component tự re-render lại.</p><p>Đây là một trong những ý tưởng cơ bản nhất đằng sau React, tuy nhiên nó có một số thuộc tính khiến nó khó sử dụng và có thể dẫn đến hành vi không mong muốn trong ứng dụng của bạn.</p><h2><strong>1. Cập nhật state</strong></h2><p>Nơi bạn có thể viết trực tiếp this.state phải là hàm constructor trong Component . Ở tất cả những nơi khác bạn nên sử dụng function this.setState, function này sẽ chấp nhận truyền vào một Object cuối cùng và sẽ được hợp nhất vào state của Component hiện tại.</p><p>Mặc dù về mặt kỹ thuật có thể thay đổi state bằng cách viết this.state trực tiếp, nhưng nó sẽ không dẫn đến việc re-rendering Component với dữ liệu mới và thường dẫn đến sự không nhất quán về trạng thái.</p><h2><strong>2. setState không đồng bộ(*)</strong></h2><p>Thực tế là setState gây ra sự hòa giải (quá trình re-rendering lại Component) là cơ sở của thuộc tính tiếp theo - setState không đồng bộ. Điều này cho phép chúng ta có nhiều lệnh gọi đến setState trong một phạm vi duy nhất và không kích hoạt khi không cần re-rendering toàn bộ Component.</p><h2><strong>3. setState chấp nhận một hàm làm tham số của nó.</strong></h2><p>Nếu bạn truyền một hàm làm đối số đầu tiên của setState, React sẽ gọi hàm đó với trạng thái tại thời điểm cuộc gọi hiện tại và muốn bạn trả lại một Object để hợp nhất thành state. Vì vậy, cập nhật lại ví dụ ở trên:</p><p>// giả sử this.state = {value: 0}; this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1}));</p>'
        ]);

        Post::create([
            'title' => 'Tìm hiểu về Service Container trong Laravel',
            'hashtag' => '#PHP',
            'like' => '500',
            'image' => 'uploads/post/laravelservice.png',
            'user_id' => '6',
            'content'=>'<p>Xin chào các anh em, hôm qua mình vừa mới phát hiện ra một điều rất hay trong Laravel mà hôm nay mình muốn lên chia sẻ ngay cho anh em. Thế nhé, mình sẽ tiếp tục series <strong>Laravel và những điều thú vị</strong> thì hôm nay mình sẽ chia sẻ cho anh em về Service Container trong Laravel, nó được dùng khắp nơi trong project của chúng ta luôn nhưng hầu như chúng ta lại không quan tâm nó cho lắm. Cho nên bài viết này mình muốn nói ra những điều hay ho thú vị về nó cho mọi người nghe. Trước tiên để tìm hiểu về Service Container thì chúng ta sẽ tìm hiểu qua một dưới đây trước nhá.</p><h2><strong>1.Denpendency Injection &amp; Inversion of Control</strong></h2><p>Trước tiên chúng ta cần phân biệt 3 khái niệm sau đây nhé:</p><p>Denpendency Inversion: là một nguyên lý thiết kế và viết code.</p><p>Inversion of Control: Đây là một design partern nằm trong nguyên lý SOLID, nó được tạo ra để tuân thủ theo nguyên lý Denpendency Inversion. Có rất nhiều cách để thực hiện partern này, Dependency Inversion là một trong số những cách đó.</p><p>Dependency Injection: Đây là một design partern để thực hiện Inversion of Control. Dependency Injection là cách tổ chức source code, sao cho có thể inject (tiêm) các đối tượng dependency vào trong đối tượng mà nó dependent. Các bạn có thể hiểu đơn giản như này, nếu class A phụ thuộc vào các class khác tức là bên trong class A khởi tạo nhiều đối tượng khác trong đó thì chúng ta có thể truyền những instance của class con đó trong hàm __contruct hoặc hàm setter</p><p>Và nó có 3 kiểu DI:</p><ul><li>Constructor Injection: Các dependency sẽ được container truyền vào (inject vào) 1 class thông qua constructor của class đó. Đây là cách thông dụng nhất.</li><li>Setter Injection: Các dependency sẽ được truyền vào 1 class thông qua các hàm Setter.</li><li>Interface Injection: Class cần inject sẽ implement 1 interface. Interface này chứa 1 hàm tên Inject. Container sẽ injection dependency vào 1 class thông qua việc gọi hàm Inject của interface đó. Đây là cách rườm rà và ít được sử dụng nhất.</li></ul>'
        ]);

        Post::create([
            'title' => 'Laravel Livewire - SPA say no Javascript',
            'hashtag' => '#livewire, #PHP',
            'like' => '200',
            'image' => 'uploads/post/livewire.png',
            'user_id' => '4',
            'content'=> '<h2><strong>Giới thiệu</strong></h2><p>Laravel Livewire là một frontend framework package dùng trong Laravel. Với Laravel Livewire, chúng ta có thể chạy code PHP giống như Javascript. Đây thực sự là một frontend framework package thú vị và hay ho dành cho những người đang sử dụng Laravel. Đặc biệt là các dự án Laravel đang muốn build từ hệ thống cũ sang dạng SPA.</p><p>Hôm nay tôi muốn giới thiệu với các bạn Laravel Livewire thông qua ứng dụng CRUD đơn giản, trước tiên chúng ta setup 1 vài thứ và demo xem nó có hoạt động không đã nhé.</p><p>&nbsp;</p><h3><strong>1. Install project Laravel</strong></h3><p>Kể từ phiên bản 6 trở đi, khi sử dụng lệnh command php artisan make:auth thì laravel không cung cấp view nữa. Để tiết kiệm thời gian thì ta sẽ sử dụng phiên bản 5.8 ổn định.</p><p>Đừng quên tạo database trong mysql và kết nối laravel với db nhé. Sau đó migrate để tạo các table</p><h3><strong>2. Tạo model và migration</strong></h3><p>Bài toán: Thêm, sửa, xóa, xem danh sách liên lạc bao gồm họ tên, số điện thoại, địa chỉ. Ta sẽ gọi đối tượng này là Contact và tạo migration, model cho chúng</p><h3><strong>3. Install Laravel Livewire</strong></h3><p>Chúng ta sẽ install package thông qua composer command</p><h3><strong>4. Chạy thử package với chức năng count</strong></h3><p>Với Laravel Livewire chúng ta không cần phải sử dụng bất kỳ route API nào cho SPA. Cũng giống như với mọi ứng dụng web sử dụng Laravel ta chỉ cần khai báo 1 route trong routes/web.php. Với chức năng CRUD đơn giản thì ta chỉ cần route như sau</p><p>Tạo file view</p><p>Bạn sẽ thấy ở file view chúng ta sử dụng directive với contact-component là tên component. Cũng giống như React hay Vue, Laravel Livewire cũng sử dụng component cho việc xây dựng SPA.</p><p>Laravel Livewire cung cấp câu lệnh command để tạo component:</p>'
        ]);

        Question::create([
            'title' => 'Cách phân chia thời gian hợp lý!',
            'hashtag' => '#hoidap',
            'like' => '100',
            'user_id' => '5',
            'content' =>'<p>Hiện tại mình đang mất khá nhiều thời gian vào game và những chuyện không mang lại nhiều lợi ích cho mình. Mình nhận ra cứ vậy mãi thì mình sẽ chẳng được gì. Nên mong các bạn chia sẻ giúp mình cách phân chia thời gian hợp lý và cách bỏ game :></p>'
        ]);

        Question::create([
            'title' => 'Gặp lỗi về cách truyền giá trị giữa các component',
            'hashtag' => '#reactjs',
            'like' => '500',
            'user_id' => '3',
            'content' =>'<p>Em đang học tới phần useState trong reactjs nhưng vẫn gặp lỗi về việc truyền giá trị giữa các component với nhau. Mong mọi người chỉ giáo ạ!</p>'
        ]);
    }
}
