<?php

namespace App\Http\Livewire\Console\Settings;

use App\Setting;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class Index extends Component
{
    /**
     * publi variable
     */
    public $settingId       = '';
    public $admin_title     = '';
    public $admin_footer    = '';
    public $site_title      = '';
    public $site_footer     = '';
    public $email_recived   = '';
    public $city            = '';
    public $keywords        = '';
    public $description     = '';
    public $logo            = '';

    /**
     * listeners
     */
    protected $listeners = [
        'fileUpload'     => 'handleFileUpload',
    ];

    /**
     * handle file upload & check file type
     */
    public function handleFileUpload($file)
    {
        try {
            if($this->getFileInfo($file)["file_type"] == "image"){
                $this->logo = $file;
            }else{
                session()->flash("error_image", "Uploaded file must be an image");
            }
        } catch (Exception $ex) {

        }
    }

    /**
     * get file info
     */
    public function getFileInfo($file)
    {
        $info = [
            "decoded_file" => NULL,
            "file_meta" => NULL,
            "file_mime_type" => NULL,
            "file_type" => NULL,
            "file_extension" => NULL,
        ];
        try{
            $info['decoded_file'] = base64_decode(substr($file, strpos($file, ',') + 1));
            $info['file_meta'] = explode(';', $file)[0];
            $info['file_mime_type'] = explode(':', $info['file_meta'])[1];
            $info['file_type'] = explode('/', $info['file_mime_type'])[0];
            $info['file_extension'] = explode('/', $info['file_mime_type'])[1];
        }catch(Exception $ex){

        }

        return $info;
    }

    /**
     * store image
     */
    public function storeImage()
    {
        $image   = ImageManagerStatic::make($this->logo)->encode('png');
        $name  = Str::random() . '.png';
        Storage::disk('public')->put('logo/'.$name, $image);
        return $name;
    }

    public function mount()
    {
        $setting = Setting::find(1);

        if($setting) {

            $this->settingId        = $setting->id;
            $this->admin_title      = $setting->admin_title;
            $this->admin_footer     = $setting->admin_footer;
            $this->site_title       = $setting->site_title;
            $this->site_footer      = $setting->site_footer;
            $this->email_recived    = $setting->email_recived;
            $this->city             = $setting->city;
            $this->keywords         = $setting->keywords;
            $this->description      = $setting->description;
            $this->logo             = $setting->logo;

        }

    }

    /**
     * update function
     */
    public function update()
    {
        $this->validate([
            'admin_title'   => 'required',
            'admin_footer'  => 'required',
            'site_title'    => 'required',
            'site_footer'   => 'required',
            'email_recived' => 'required|email',
            'city'          => 'required',
            'keywords'      => 'required',
            'description'   => 'required',
        ]);

        $setting = Setting::find($this->settingId);

        if($setting) {

            $setting->update([
                'admin_title'   => $this->admin_title,
                'admin_footer'  => $this->admin_footer,
                'site_title'    => $this->site_title,
                'site_footer'   => $this->site_footer,
                'email_recived' => $this->email_recived,
                'city'          => $this->city,
                'keywords'      => $this->keywords,
                'description'   => $this->description,
            ]);

            session()->flash('success', 'Data updated successfully');

            redirect()->route('console.settings.index');

        }

    }

    /**
     * logo update function
     */
    public function update_logo()
    {
        $setting = Setting::find($this->settingId);

        if($setting) {

            $setting->update([
                'logo'   => $this->storeImage()
            ]);

            session()->flash('success', 'Logo updated successfully');

            redirect()->route('console.settings.index');

        }
    }

    public function render()
    {
        return view('livewire.console.settings.index');
    }
}
