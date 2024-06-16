<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $BLOGID = $_ENV['BLOGGER_ID'];
        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', 'https://www.googleapis.com/blogger/v3/blogs/'.$BLOGID.'/posts?key='.$_ENV['BLOGGER']);

        $data = [ 'blogs' => json_decode($response->getBody())->items];
        // $data = [ 'blogs' => []];
        $jsonld = '';
        echo view('main/mHeader', ['title'=>"About Klients Aspire LTD", 'desc'=>"Learn more about us", 'jsonld'=>$jsonld]);
        echo view('main/home', $data);
        echo view('main/mFooter');
    }


    public function blog()
    {
        $BLOGID = $_ENV['BLOGGER_ID'];
        $client = \Config\Services::curlrequest();

        $response = $client->request('GET', 'https://www.googleapis.com/blogger/v3/blogs/'.$BLOGID.'/posts?key='.$_ENV['BLOGGER']);

        $data = [ 'blogs' => json_decode($response->getBody())->items];
        $jsonld = '';

        // dd($data);
        echo view('main/mHeader', ['title'=>"About Klients Aspire LTD", 'desc'=>"Learn more about us", 'jsonld'=>$jsonld]);
        echo view('main/blog', $data);
        echo view('main/mFooter');
    }

    public function gallery()
    {
        dd($this->googlePhotos());    
    }

    public function tests()
    {
        // $Variable = new \App\Models\Variable();

        // $res = $this->trials();
        // $NEWetag = json_decode($res)->etag;
        // $OLDetag = json_decode($Variable->where('id','1')->find()[0]['value'])->etag;
        // if($NEWetag == $OLDetag){
        //     echo "No Need to UPDATE";
        // }else{
        //     echo "Please UPDATE me";
        //     $Variable->update(1, ['key'=>'pages', 'value'=>$res]);
        // }
        // $db = db_connect();
        // $db->query('CREATE TABLE variable (id INTEGER PRIMARY KEY, key TEXT, value TEXT)');
        // $Variable->insert(['id'=>1,'key'=>'pages', 'value'=>$res]);
        // $Variable->delete('2');
        // dd($Variable->findAll());

        // To cache and Trigger, create a google APP script to call a webhook after etag has changed
    }


    public function blogD($id)
    {
        $BLOGID = $_ENV['BLOGGER_ID'];
        $client = \Config\Services::curlrequest();
        // dd($id);

        $response = $client->request('GET', 'https://www.googleapis.com/blogger/v3/blogs/'.$BLOGID.'/posts/'.$id.'?key='.$_ENV['BLOGGER']);

        $data = [ 'blog' => json_decode($response->getBody())
        ];

        dd($data);
        // echo view('header');
        // echo view('blogSingle', $data);
        // echo view('footer');
    }

    public function pages($pg='')
    {
        switch ($pg) {
            case 'about':
                $jsonld = '';
                echo view('main/header', ['title'=>"About Klients Aspire LTD", 'desc'=>"Learn more about us", 'jsonld'=>$jsonld]);
                echo view('main/pages', $this->loadPage('7775276068026621191'));
                echo view('main/footer');
                break;
            
            default:
               echo "404 Not found";
                break;
        }
    }

    private function googlePhotos($token='Puqwxek1sBVpmvud9')
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'https://galleria.sgm.ng/'.$token);

        $res =  json_decode($response->getBody());
        $ret = [];

        foreach ($res as $key => $gal) {
            if($key == 0){
            }else{
                // $ret[$key] = $gal;
                array_push($ret, $gal);
            }
        }

        return $ret;
    }


    public function singleBlog($y,$m,$t)
    {
        $path = $y.'/'.$m.'/'.$t;
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'.$_ENV['BLOGGER_ID'].'/posts/bypath?path=/'.$path.'&key='.$_ENV['BLOGGER'];
        $res = $this->loadContent($url);
        $re = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i';preg_match($re, $res->content, $matches, PREG_OFFSET_CAPTURE, 0); $extractedIMG = $matches[1][0];
        $cleanText = preg_replace('/<(?:[^"\'>]|".*?"|\'.*?\')*>|<\/?[a-zA-Z]+\b[^>]*>|[\r\n\t]+/s', '', $res->content);
        $jsonld = '
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": "'.$res->title.'",
            "image": "'.$extractedIMG.'",
            "datePublished": "'.$res->published.'",
            "dateModified": "'.$res->updated.'",
            "author": {
                "@type": "Person",
                "name": "Klients Aspire LTD"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Klients Aspire LTD",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://phfogun.org.ng/assets/img/phf_logo.png"
                }
            },
            "description": "'.substr($cleanText, 0, 300).'",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "'.base_url('blog/'.$path).'"
            }';
        $data = [
            'id' => $res->id,
            'published' => explode('T', $res->published)[0] ,
            'labels' => $res->labels[0],
            'title' => $res->title,
            'content' => $res->content,
            'url' => base_url('blog/'.$path),
        ];
        echo view('main/mHeader', ['title'=>$data['title']."|| Klients Aspire LTD", 'desc'=>"Read and learn more as it is an obligation from cradle to grave", 'jsonld'=>$jsonld]);
        echo view('main/pages', $data);
        echo view('main/mFooter');
    }

    private function loadPage($pageID)
    {
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'.$_ENV['BLOGGER_ID'].'/pages/'.$pageID.'?key='.$_ENV['BLOGGER'];
        $res = $this->loadContent($url);
        return ['title'=>$res->title, 'content'=>$res->content];
    }

    private function loadPostASPage($path)
    {
        $url = 'https://www.googleapis.com/blogger/v3/blogs/'.$_ENV['BLOGGER_ID'].'/posts/bypath?path=/'.$path.'&key='.$_ENV['BLOGGER'];
        $res = $this->loadContent($url);
        return ['title'=>$res->title, 'content'=>$res->content];
    }

    private function loadContent($url)
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', $url);
        // dd($response->getBody());
        return json_decode($response->getBody());
    }

    private function trials()
    {
        $client = \Config\Services::curlrequest();
        $response = $client->request('GET', 'https://www.googleapis.com/blogger/v3/blogs/'.$_ENV['BLOGGER_ID'].'/pages/'.'?key='.$_ENV['BLOGGER']);
        return $response->getBody();
    }
}
