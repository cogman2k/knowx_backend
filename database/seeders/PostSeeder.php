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
            'title' => 'Android Developer',
            'hashtag' => '#android, #laptrinhdidong',
            'like' => '13',
            'image' => 'uploads/post/1640175451.png',
            'user_id' => '3',
            'content'=> '<p><strong>Broken Down Version</strong></p><p>Below is the broken down version of the roadmap with links and resources to learn more about each of the items listed in the complete roadmap above.</p><p><strong>Pick a Language</strong></p><p>For the languages, you can develop android apps either by using Kotlin or Java.</p><p><strong>The Fundamentals</strong></p><p>Install the Android Studio&nbsp;and learn the basics of Kotlin to get started.</p><p><strong>Version Control Systems</strong></p><p>Version control systems record your changes to the codebase and allow you to recall specific versions later. There are multiple Version Control Systems available but&nbsp;<a href="https://git-scm.com/"><strong>Git</strong></a>&nbsp;is the most common one these days.</p><p><strong>Wrap Up</strong></p><p>That wraps it up for the android developer roadmap. Again, remember to not be exhausted by the list; just learn the basics and start working on some project, rest of the learnings will come along the way. Good luck!</p>'
        ]);

        Post::create([
            'title' => 'How to Learn ASP.NET Core With a Roadmap in 2021?',
            'hashtag' => '#asp',
            'like' => '10',
            'image' => 'uploads/post/1640179277.png',
            'user_id' => '3',
            'content'=> '<h2>What is ASP.NET Core?</h2><p><a href="https://dotnet.microsoft.com/learn/aspnet/what-is-aspnet">ASP.NET</a>&nbsp;is a popular web development framework for building web apps on the&nbsp;<a href="https://dotnet.microsoft.com/learn/dotnet/what-is-dotnet">.NET platform</a>.</p><p>ASP.NET Core is the open-source version of ASP.NET, that runs on macOS, Linux, and Windows. ASP.NET Core was first released in 2016 and is a re-design of earlier Windows-only versions of ASP.NET.Learn the prerequisites</p><h2>Learn the prerequisites</h2><p>It is a long road. It can be more understandable if I share this in sections.</p><p>So, it is the first one.</p><h2>General Development Skills</h2><ul><li>Data Structures and Algorithms</li><li>GIT Version Control(VSTS, GitHub, GitLab)</li><li>HTTP / HTTPS Protocol</li><li>Learn to search for solutions</li></ul><h2>C# ( C Sharp Programming Language)</h2><ul><li>Learn the basics of C# 9.0</li><li>Learn .NET 5</li><li>Learn Dotnet CLI</li></ul><h2>General Development Skills</h2><h2>Data Structures and Algorithms</h2><p>The data structure and algorithm provide a set of techniques to the programmer to process the data effectively. The programmer must understand the fundamental concepts of manipulating data. For example, if the programmer wants to collect the Instagram user’s details, the applicant must access the data and manage it effectively using the data structure and algorithm techniques.</p><h2>GIT Version Control(VSTS, GitHub, GitLab)</h2><p>GitHub is a website for developers and programmers to collaboratively work on code.</p><p>The primary benefit of GitHub is its version control system, which allows for seamless collaboration without compromising the integrity of the original project. The projects on GitHub are examples of open-source software.</p><p>GitLab is a web-based&nbsp;lifecycle tool that provides a Git-repository manager providing wiki, issue-tracking, and&nbsp;features, using an open-source license, developed by&nbsp;Inc.</p><h2>HTTP / HTTPS Protocol</h2><p>The HyperText Transfer Protocol () is the underlying network&nbsp;<a href="https://developer.mozilla.org/en-US/docs/Glossary/Protocol">protocol</a>&nbsp;that enables the transfer of hypermedia documents on the&nbsp;<a href="https://developer.mozilla.org/en-US/docs/Glossary/World_Wide_Web">Web</a>, typically between a browser and a server so that humans can read them.</p><p>Hypertext transfer protocol secure () is the secure version of HTTP, which is the primary protocol used to send data between a web browser and a website. HTTPS is encrypted to increase the security of data transfer. It’s critical when specific users typically transmit sensitive data, such as by logging into a bank account, email service, or health insurance provider.</p><h2>Learn to search for solutions</h2><p>Most of the beginners and even experienced programmers take help from some resources. When you take help them, it makes you a better programmer and a good debugger as well. Every programmer should check all these websites where people ask tricky programming questions, give solutions and help each other.</p><h2>Use These :</h2><ul><li>StackOverflow</li><li>Reddit</li><li>Quora</li><li>Telegram/Whatsapp Groups</li><li>Coding Forums</li></ul><h2>C# ( C Sharp Programming Language)</h2><h2>Learn C#</h2><p>Like Java, C# is one of the<a href="https://stackify.com/popular-programming-languages-2018/">&nbsp;most popular programming languages</a>&nbsp;has a large, active user community, making it easy to find troubleshooting solutions and coding help on StackOverflow and other online communities.</p><p>Microsoft released the C# language back in 2001. However, as of 2019, C# continues to be in huge demand. It is especially true since the release of .NET Core, and the trend is likely to go up.</p><p>C# is the most popular programming language in the Microsoft ecosystem of products. C# code designed to run fast and to be easily maintainable. In C# Basics, we’ll learn how to work with C# to write simple programs.</p><h2>What you should learn for basics</h2><ul><li>C# syntax</li><li>Types</li><li>Strings</li><li>Numbers</li><li>If statements</li><li>Methods</li></ul><h2>Learn .NET 5</h2><p>.NET is a programming platform created by Microsoft. Here are the most important features:</p><ul><li>You can write in many languages: C #, F #, and VB.NET</li><li>Libraries written in different languages ​​in .NET can work together because they compile into IL intermediate code</li><li>.NET 5 and associated technologies are open their sources are available on the GitHub platform</li><li>in .NET 5, you can build console applications, websites, APIs, games, mobile applications, and desktop computers</li><li>.NET is extremely popular. It has many ready integrations with Amazon or Google technologies, but the easiest way will be to work with Microsoft products and the Azure cloud</li></ul><h2>Learn Dotnet CLI</h2><p>The .NET command-line interface (CLI) is a cross-platform toolchain for developing, building, running, and publishing .NET applications.</p><p>The .NET CLI includes the&nbsp;<a href="https://docs.microsoft.com/tr-tr/dotnet/core/sdk">.NET SDK</a>. To learn how to install the .NET SDK, see&nbsp;<a href="https://docs.microsoft.com/tr-tr/dotnet/core/install/windows">Install .NET Core</a>.</p>'
        ]);

        Post::create([
            'title' => 'Tìm hiểu setState() trong Reactjs',
            'hashtag' => '#reactjs',
            'like' => '110',
            'image' => 'uploads/post/react.png',
            'user_id' => '7',
            'content'=>'<p>Compnent state là cách lưu trữ, xử lý và sử dụng thông tin bên trong một Component nhất định và cho phép bạn thực hiện logic của nó. State thường là một POJO (Đối tượng Java [Script] thuần túy), và thay đổi nó là một trong số ít cách để tạo Component tự re-render lại.</p><p>Đây là một trong những ý tưởng cơ bản nhất đằng sau React, tuy nhiên nó có một số thuộc tính khiến nó khó sử dụng và có thể dẫn đến hành vi không mong muốn trong ứng dụng của bạn.</p><h2><strong>1. Cập nhật state</strong></h2><p>Nơi bạn có thể viết trực tiếp this.state phải là hàm constructor trong Component . Ở tất cả những nơi khác bạn nên sử dụng function this.setState, function này sẽ chấp nhận truyền vào một Object cuối cùng và sẽ được hợp nhất vào state của Component hiện tại.</p><p>Mặc dù về mặt kỹ thuật có thể thay đổi state bằng cách viết this.state trực tiếp, nhưng nó sẽ không dẫn đến việc re-rendering Component với dữ liệu mới và thường dẫn đến sự không nhất quán về trạng thái.</p><h2><strong>2. setState không đồng bộ(*)</strong></h2><p>Thực tế là setState gây ra sự hòa giải (quá trình re-rendering lại Component) là cơ sở của thuộc tính tiếp theo - setState không đồng bộ. Điều này cho phép chúng ta có nhiều lệnh gọi đến setState trong một phạm vi duy nhất và không kích hoạt khi không cần re-rendering toàn bộ Component.</p><h2><strong>3. setState chấp nhận một hàm làm tham số của nó.</strong></h2><p>Nếu bạn truyền một hàm làm đối số đầu tiên của setState, React sẽ gọi hàm đó với trạng thái tại thời điểm cuộc gọi hiện tại và muốn bạn trả lại một Object để hợp nhất thành state. Vì vậy, cập nhật lại ví dụ ở trên:</p><p>// giả sử this.state = {value: 0}; this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1})); this .setState ((state) =&gt; ({value: state.value + 1}));</p>'
        ]);

        Post::create([
            'title' => 'Tìm hiểu về Service Container trong Laravel',
            'hashtag' => '#PHP',
            'like' => '65',
            'image' => 'uploads/post/laravelservice.png',
            'user_id' => '6',
            'content'=>'<p>Xin chào các anh em, hôm qua mình vừa mới phát hiện ra một điều rất hay trong Laravel mà hôm nay mình muốn lên chia sẻ ngay cho anh em. Thế nhé, mình sẽ tiếp tục series <strong>Laravel và những điều thú vị</strong> thì hôm nay mình sẽ chia sẻ cho anh em về Service Container trong Laravel, nó được dùng khắp nơi trong project của chúng ta luôn nhưng hầu như chúng ta lại không quan tâm nó cho lắm. Cho nên bài viết này mình muốn nói ra những điều hay ho thú vị về nó cho mọi người nghe. Trước tiên để tìm hiểu về Service Container thì chúng ta sẽ tìm hiểu qua một dưới đây trước nhá.</p><h2><strong>1.Denpendency Injection &amp; Inversion of Control</strong></h2><p>Trước tiên chúng ta cần phân biệt 3 khái niệm sau đây nhé:</p><p>Denpendency Inversion: là một nguyên lý thiết kế và viết code.</p><p>Inversion of Control: Đây là một design partern nằm trong nguyên lý SOLID, nó được tạo ra để tuân thủ theo nguyên lý Denpendency Inversion. Có rất nhiều cách để thực hiện partern này, Dependency Inversion là một trong số những cách đó.</p><p>Dependency Injection: Đây là một design partern để thực hiện Inversion of Control. Dependency Injection là cách tổ chức source code, sao cho có thể inject (tiêm) các đối tượng dependency vào trong đối tượng mà nó dependent. Các bạn có thể hiểu đơn giản như này, nếu class A phụ thuộc vào các class khác tức là bên trong class A khởi tạo nhiều đối tượng khác trong đó thì chúng ta có thể truyền những instance của class con đó trong hàm __contruct hoặc hàm setter</p><p>Và nó có 3 kiểu DI:</p><ul><li>Constructor Injection: Các dependency sẽ được container truyền vào (inject vào) 1 class thông qua constructor của class đó. Đây là cách thông dụng nhất.</li><li>Setter Injection: Các dependency sẽ được truyền vào 1 class thông qua các hàm Setter.</li><li>Interface Injection: Class cần inject sẽ implement 1 interface. Interface này chứa 1 hàm tên Inject. Container sẽ injection dependency vào 1 class thông qua việc gọi hàm Inject của interface đó. Đây là cách rườm rà và ít được sử dụng nhất.</li></ul>'
        ]);

        Post::create([
            'title' => 'Laravel Livewire - SPA say no Javascript',
            'hashtag' => '#livewire, #PHP',
            'like' => '39',
            'image' => 'uploads/post/livewire.png',
            'user_id' => '4',
            'content'=> '<h2><strong>Giới thiệu</strong></h2><p>Laravel Livewire là một frontend framework package dùng trong Laravel. Với Laravel Livewire, chúng ta có thể chạy code PHP giống như Javascript. Đây thực sự là một frontend framework package thú vị và hay ho dành cho những người đang sử dụng Laravel. Đặc biệt là các dự án Laravel đang muốn build từ hệ thống cũ sang dạng SPA.</p><p>Hôm nay tôi muốn giới thiệu với các bạn Laravel Livewire thông qua ứng dụng CRUD đơn giản, trước tiên chúng ta setup 1 vài thứ và demo xem nó có hoạt động không đã nhé.</p><p>&nbsp;</p><h3><strong>1. Install project Laravel</strong></h3><p>Kể từ phiên bản 6 trở đi, khi sử dụng lệnh command php artisan make:auth thì laravel không cung cấp view nữa. Để tiết kiệm thời gian thì ta sẽ sử dụng phiên bản 5.8 ổn định.</p><p>Đừng quên tạo database trong mysql và kết nối laravel với db nhé. Sau đó migrate để tạo các table</p><h3><strong>2. Tạo model và migration</strong></h3><p>Bài toán: Thêm, sửa, xóa, xem danh sách liên lạc bao gồm họ tên, số điện thoại, địa chỉ. Ta sẽ gọi đối tượng này là Contact và tạo migration, model cho chúng</p><h3><strong>3. Install Laravel Livewire</strong></h3><p>Chúng ta sẽ install package thông qua composer command</p><h3><strong>4. Chạy thử package với chức năng count</strong></h3><p>Với Laravel Livewire chúng ta không cần phải sử dụng bất kỳ route API nào cho SPA. Cũng giống như với mọi ứng dụng web sử dụng Laravel ta chỉ cần khai báo 1 route trong routes/web.php. Với chức năng CRUD đơn giản thì ta chỉ cần route như sau</p><p>Tạo file view</p><p>Bạn sẽ thấy ở file view chúng ta sử dụng directive với contact-component là tên component. Cũng giống như React hay Vue, Laravel Livewire cũng sử dụng component cho việc xây dựng SPA.</p><p>Laravel Livewire cung cấp câu lệnh command để tạo component:</p>'
        ]);

        Post::create([
            'title' => 'Làm thế nào để hạn chế conflict khi làm việc với GIT',
            'hashtag' => '#git',
            'like' => '41',
            'image' => 'uploads/post/1640335275.jpg',
            'user_id' => '7',
            'content'=> '<ul><li>Define cấu trúc source code, <strong>modulle hoá</strong> ngay từ sớm: để tránh conflict thì việc quan trọng nhất vẫn là hạn chế tối đa việc code chung một file, một dòng. Các bạn nên chia nhỏ ứng dụng thành các module nhỏ và chi cho mỗi developer một module nếu có thể.</li><li>Một số <strong>quy ước</strong> trước khi tiến hành code: trước khi code chúng ta nên có những quy ước riêng của team trước khi code để tránh conflict code, ví dụ như tách thành những file, sử dụng import/export thay vì viết tất cả các hàm trong một file, các function mới sẽ được define ở dưới cùng....</li><li>Dữ cho <strong>thay đổi của bạn là ít nhất</strong>:<ul><li>hạn chế thay đổi các dòng/file có sẵn nếu có thế, thay vào đó các bạn có thể thêm dòng mới.</li><li>Ngoài ra "hay đổi của bạn là ít nhất" cũng hiểu là không nên thay đổi qua nhiều source trong một lần tạo merge request. Các bạn nên tạo merge request cho mỗi feature NHỎ, không nên dồn quá nhiều source code vào một merge reuqest để tránh conflict cũng dễ dàng hơn cho người review các merge quest của bạn</li></ul></li><li>Rebase hoặc merge từ base branch (thường là branch develop trong work flow) trước khi tạo merge request. Trước khi tạo merge request lên cho người khác review bạn <strong>PHẢI rebase hoặc merge</strong> ( mình thì mình thích merge hơn 😌 ) vì hai nguyên nhân:<ul><li>Nếu có conflict code với base branch thì bạn sẽ resolve ở local trước khi push lên và tạo merge reuqest. Việc này không tránh được hoàn toàn conflict nhưng sẽ phát hiện và xử lý sớm (vì để đến người review thì họ cũng sẽ reject và bắt bạn resolve conflict trước thôi :v )</li><li>Lấy source mới về để chắc chắn là các function khách không ảnh hưởng đến function của bạn. ví dụ như bạn có một function dùng chung đã bị xoá bởi một member khách nhưng bạn vẫn gọi đến hàm đó làm cho hệ thống bui fail (lúc đấy thì lại được bao nước cả team thì... 😜 ).</li></ul></li><li>Kiểm tra trươc khi tạo merge reuqest và assign cho reviewer: các bạn nên <strong>self review</strong> trước khi tạo merge reuqest và assign cho người reivew. Tốt nhất là team nên define một check list hoặc nếu không có thì các bạn cũng nên tự có một check list: không bị conflict code, coding convention, đã xoá hết console log, tên biến có thể hiểu được, vân vân và mây mây các thứ.... để có thể tự review merge request của mình.</li></ul>'
        ]);

        Question::create([
            'title' => 'Cách phân chia thời gian hợp lý!',
            'hashtag' => '#hoidap',
            'like' => '40',
            'subject_id' => 'none',
            'user_id' => '5',
            'content' =>'<p>Hiện tại mình đang mất khá nhiều thời gian vào game và những chuyện không mang lại nhiều lợi ích cho mình. Mình nhận ra cứ vậy mãi thì mình sẽ chẳng được gì. Nên mong các bạn chia sẻ giúp mình cách phân chia thời gian hợp lý và cách bỏ game :></p>'
        ]);

        Question::create([
            'title' => 'Gặp lỗi về cách truyền giá trị giữa các component',
            'hashtag' => '#reactjs',
            'like' => '200',
            'subject_id' => 'none',
            'user_id' => '3',
            'content' =>'<p>Em đang học tới phần useState trong reactjs nhưng vẫn gặp lỗi về việc truyền giá trị giữa các component với nhau. Mong mọi người chỉ giáo ạ!</p>'
        ]);

        Question::create([
            'title' => 'Quy đổi đơn vị trong php laravel',
            'hashtag' => '#php',
            'like' => '3',
            'subject_id' => 'none',
            'user_id' => '4',
            'content' =>'<p>Mình đang làm 1 web bán hàng. mình muốn quy đổi giá trị như 1.000.000 thành 1 triệu, 3.500.000.000 thành 3.5 tỷ thì phải làm thế nào ạ. Mình cảm ơn</p>'
        ]);

        Question::create([
            'title' => '[ React-Query ] : RefetchInterval theo điều kiện data trả về',
            'hashtag' => '#react',
            'like' => '8',
            'subject_id' => 'none',
            'user_id' => '6',
            'content' =>'<p>Chào mọi người, mình đang làm dự án có sử dụng thư viện react-query để thực hiện fetch data. Mình có một case thế này, giả dụ mình vào một trang detail của product - một product sẽ có hai trạng thái là <strong>pending</strong> và <strong>collected</strong> Lúc mới tạo nó sẽ là pending, và trong trang detail đo mình sử dụng useQuery() để fetch data về đang config thuộc tính refetchInterval:5000</p><p>Để nó liên tục cập nhật trạng thái mới nhất của sản phẩm. Và mình muốn khi data trả về có trạng thái mới là <strong>collected</strong> rồi thì nó sẽ không thực hiện refetchInterval nữa</p><p>Mình chưa biết xử lý case này thế nào (có tra google rồi nhưng ko tìm đc giải pháp), mong mọi người chỉ cách giúp mình với ạ. Xin cám oiwn các bạn nhiều</p><p><br>&nbsp;</p>'
        ]);

        Question::create([
            'title' => 'Mysql convert Mongodb',
            'hashtag' => '#mysql',
            'like' => '5',
            'subject_id' => 'none',
            'user_id' => '5',
            'content' =>'<p>Mình có câu truy vấn mysql như này giờ muốn chuyển sang mongoDB thì làm như nào ạ. Rất mong được giúp đỡ .</p>'
        ]);

        Question::create([
            'title' => '[ReactJS] - useEffect trong component con không hoạt động',
            'hashtag' => '#reactjs, #useeffect',
            'like' => '3',
            'subject_id' => 'none',
            'user_id' => '4',
            'content' =>'<p>Mình có 1 trang web gồm 1 compnent con và cha đều có useEffect, nhưng khi reload trang thì chỉ có useEffect của component cha chạy, component con thì không. Mình đã sử dụng async await nhưng cũng chưa được. Nhờ các bạn giải đáp giúp mình ạ!</p>'
        ]);

        Question::create([
            'title' => 'Thắc mắc về cách hoạt động của next-redux-wrapper',
            'hashtag' => '#nextjs, #redux',
            'like' => '2',
            'subject_id' => 'none',
            'user_id' => '7',
            'content' =>'<p>mình đang tìm hiểu về cách sử dụng redux với nextjs, qua tìm hiểu thì để sử dụng redux khi ssr cần next-redux-wrapper, khi mình tìm hiểu chỉ có hướng dẫn cách sử dụng như thế nào mà không thấy nói rõ nguyên tắc hoạt động nó ntn ( ví dụ như hydrate, mình đang ko hiểu nó là cái gì và làm gì ,.... ), mong mọi ng giúp ạ</p>'
        ]);

        Question::create([
            'title' => 'Lớp mình cuối tuần có thời gian để meeting không ạ?',
            'hashtag' => '#meeting',
            'like' => '2',
            'subject_id' => 'none',
            'class_id' => '1',
            'user_id' => '8',
            'content' =>'<p>Cuối tuần này mình muốn meeting hỏi các bạn và mentor chút về roadmap. Mọi người và mentor có thời gian không ạ?</p>'
        ]);
    }
}
