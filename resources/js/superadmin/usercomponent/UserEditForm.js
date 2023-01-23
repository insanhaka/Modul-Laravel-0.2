import React, {useEffect, useState} from 'react';
import ReactDOM from 'react-dom';
import { InputText } from 'primereact/inputtext';
import { Password } from 'primereact/password';
import { MultiSelect } from 'primereact/multiselect';
import { Button } from 'primereact/button';
import { Checkbox } from 'primereact/checkbox';
import { Chip } from 'primereact/chip';
import Backdrop from '@mui/material/Backdrop';
import LoadingIMG from '../../../../public/assets/img/loading.gif'

// Data Service
import Roledata from '../../dataservice/Roledata';

function UserEditForm({id}) {

    const getRole = Roledata();
    const [loading, setLoading] = useState(false);
    const handleClose = () => {
        setLoading(false);
    };

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [role, setRole] = useState(null);
    const [oldrole, setOldrole] = useState(null);
    const [supercheck, setSupercheck] = useState(false);

    const submit = () => {
        setLoading(true)
        // Convert all atribute data role to just get ID
        const roleID = [];
        if (role !== null) {
            for (let i = 0; i < role.length; i++) {
                const dataRole = role[i].id;
                roleID.push(dataRole);
            }
        }
        // http post data form to server
        axios.post('/api/user-update', {
            id: id,
            name: name,
            email: email,
            password: password,
            role: roleID,
            is_super: supercheck,
        })
        .then(function (response) {
            const message = response.data.message
            const data = response.data.data

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            
            Toast.fire({
                icon: message,
                title: data
            })
            setLoading(false)

            console.log(data);

            // redirect
            if (message === "success") {
                window.location.replace('/super/user');
            }
            
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    useEffect(() => {
        // console.log(id);
        axios.post('/api/user-edit', {
            id: id,
        })
        .then(function (response) {
            const userOLD = response.data.user
            const roleOLD = response.data.role
            setName(userOLD.name)
            setEmail(userOLD.email)
            if (userOLD.is_super === 1) {
                setSupercheck(true)
            }
            setOldrole(roleOLD)
        })
        .catch(function (error) {
            console.log(error);
        });

    }, [])    

    return (
        <div className="container">
            <div className="row">
                <div className="col-md-12">
                    <div className="mb-3">
                        <label className="form-label">Nama</label>
                        <br/>
                        <InputText className='w-100' value={name} onChange={(e) => setName(e.target.value)} />
                    </div>
                </div>
            </div>
            <div className="row">
                <div className="col-md-6">
                    <div className="mb-3">
                        <label className="form-label">Email</label>
                        <br/>
                        <InputText className='w-100' value={email} onChange={(e) => setEmail(e.target.value)} />
                    </div>
                </div>
                <div className="col-md-6">
                    <div className="mb-3">
                        <label className="form-label">Password</label>
                        <br/>
                        <Password style={{width: '100%'}} value={password} onChange={(e) => setPassword(e.target.value)} feedback={false} toggleMask />
                    </div>
                </div>
            </div>
            <div className='row'>
                <div className='col-md-3'>
                    <div className='mb-3'>
                        <label className='form-label'>Pilih Sebagai Akun Super</label>
                        <div className="field-checkbox pt-3">
                            <Checkbox inputId="binary" checked={supercheck} onChange={e => setSupercheck(e.checked)} />
                            <label htmlFor="binary">Super Account</label>
                        </div>
                    </div>
                </div>
                <div className='col-md-9'>
                    <div className='mb-3'>
                        <label className='form-label'>Ubah Role</label>
                        <br/>
                        <MultiSelect style={{width: '100%', marginBottom: 10}} value={role} options={getRole} onChange={(e) => setRole(e.value)} optionLabel="name" placeholder="Select a Role" display="chip" />
                        <small>Role Saat Ini : </small>
                        <div className="flex align-items-center flex-wrap">
                            {oldrole !== null && oldrole.map((data) =>
                                <Chip key={data.id} label={data.name} className="mr-2 mb-2" style={{color: data.color, fontWeight: 'bold', fontSize: 11, backgroundColor: "#f7f1e3" }} />
                            )}
                        </div>
                    </div>
                </div>
            </div>
            <div className='row justify-content-end mt-3'>
                <div className='col-md-2'>
                    <div className='mb-3'>
                        <Button style={{width: '100%'}} label="Simpan" aria-label="Simpan" onClick={submit}  />
                    </div>
                </div>
            </div>

            <Backdrop
                sx={{ backgroundColor: 'rgba(255, 255, 255, 0.6)', zIndex: (theme) => theme.zIndex.drawer + 1 }}
                open={loading}
                onClick={handleClose}
            >
                {/* <CircularProgress color="inherit" /> */}
                <img src={LoadingIMG} alt="LOADING..." style={{width: 110}} />
            </Backdrop>
        </div>
    );
}

export default UserEditForm;

if (document.getElementById('edit-form')) {
    const value = document.getElementById('edit-form').getAttribute('userid');
    ReactDOM.render(<UserEditForm id={value} />, document.getElementById('edit-form'));
}
