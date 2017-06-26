/**
 * Created by josephbosire on 23/06/2017.
 */
/**
 * Created by josephbosire on 09/05/2017.
 */
import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);
export const store =  new Vuex.Store({
    state:{
        rom: {'build':{'download_path':'#'}},
    },
    getters: {
        all_rom_images(state){
            return state.rom.rom_images;
        },
        rom_id(state){
            return state.rom.id;
        },
        build(state){
            return state.rom.build;
        },
        download_path(state){
            if(state.rom.build){
                return state.rom.build.download_path;
            }
            else{
                return '#';
            }
        }
    },
    mutations: {
        update_rom(state, rom){
            state.rom=rom;
        },
        reset(state){
            state.rom = {
                rom: {'build':{'download_path':'#'}},
            };
        }
    },
    actions: {

    }
});